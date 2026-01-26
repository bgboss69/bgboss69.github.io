from transformers import AutoTokenizer, AutoModelForCausalLM
import tiktoken

# import torch
import os

# model_name = "Qwen/Qwen2.5-0.5B-Instruct"
# model_name = "Qwen/Qwen2.5-3B-Instruct"
model_name = "Qwen/Qwen2.5-1.5B-Instruct"


tokenizer = AutoTokenizer.from_pretrained(model_name, trust_remote_code=True)

# NVIDIA GPU 推荐使用以下代码加载模型
# model = AutoModelForCausalLM.from_pretrained(
#     model_name,
#     trust_remote_code=True,
#     torch_dtype=torch.float16 if torch.cuda.is_available() else torch.float32,
#     device_map="auto",
# )

# CPU 使用以下代码加载模型 我的配置是 Intel Ultra 7
model = AutoModelForCausalLM.from_pretrained(
    model_name, trust_remote_code=True, device_map="cpu"
)

folder_path = r"C:\Users\KaiYuanCHING\Desktop\python\SummaryAI\output_items"
output_file = r"C:\Users\KaiYuanCHING\Desktop\python\SummaryAI\summary_result.txt"

prompt_temp = """
请总结下面的文档内容：

【结论/建议】
- 总结性结论
- 可提出建议或局限性

文档内容如下：
"""


# Open ONE output file for writing
with open(output_file, "w", encoding="utf-8") as out_f:
    for filename in sorted(os.listdir(folder_path)):
        if filename.endswith(".txt"):
            file_path = os.path.join(folder_path, filename)

            with open(file_path, "r", encoding="utf-8") as f:
                text = f.read()

                encoding = tiktoken.get_encoding("cl100k_base")
                tokens = encoding.encode(text)
                token_count = len(tokens)
                prompt = prompt_temp + text

                # inputs = tokenizer(prompt, return_tensors="pt").to(model.device)

                # outputs = model.generate(
                #     **inputs, max_new_tokens=800, temperature=0.3, top_p=0.9, do_sample=True
                # )

                # result = tokenizer.decode(outputs[0], skip_special_tokens=True)

                inputs = tokenizer(prompt, return_tensors="pt").to(model.device)

                # outputs = model.generate(
                #     **inputs,  # 输入的 token 编码（模型根据它开始生成文本）
                #     do_sample=True,  # 开启采样模式（用随机采样而不是贪婪解码）
                #     # 如果为 False，就总是选概率最高的 token（确定性更强）:contentReference[oaicite:1]{index=1}
                #     temperature=0.7,  # “温度”参数，控制随机性
                #     # 小于 1：降低随机性（更确定、连贯）
                #     # 大于 1：增加随机性（更有创造性）:contentReference[oaicite:2]{index=2}
                #     top_p=0.9,  # nucleus 采样（保留累计概率 ≥ 0.9 的 token 集合，再从里面抽取）
                #     # 让模型只在概率较高的 token 中采样，而不是全部词表:contentReference[oaicite:3]{index=3}
                #     top_k=50,  # top‑k 采样（每步只保留概率最高的前 50 个词）
                #     # 在保留的 50 个里随机选，有助于控制生成多样性:contentReference[oaicite:4]{index=4}
                #     max_new_tokens=int(
                #         token_count / 10
                #     ),  # 最大生成新 token 数量（不包含输入 prompt）
                #     # 生成达到 100 个新 token 就停止:contentReference[oaicite:5]{index=5}
                # )
                outputs = model.generate(
                    **inputs,
                    do_sample=True,
                    temperature=0.2,
                    top_p=0.85,
                    top_k=0,              # 关闭 top_k，避免过度随机
                    max_new_tokens=max(100, token_count // 8),
                    repetition_penalty=1.1,
                )


                # outputs = model.generate(
                #     **inputs,
                #     max_new_tokens=400,
                #     do_sample=False,
                # )

                # 只取生成的部分（不包括输入）
                generated_tokens = outputs[0][inputs["input_ids"].shape[1] :]
                result = tokenizer.decode(generated_tokens, skip_special_tokens=True)

                # Write summary to ONE file
                out_f.write(f"\n{'=' * 60}\n")
                out_f.write(f"File: {filename}\n")
                out_f.write(f"{'=' * 60}\n")
                out_f.write(result + "\n\n")

                print(f"✔ Summarized: {filename}")

print("✅ All summaries saved to summary_result.txt")


# max_new_tokens = 1000
# temperature = 0.2~0.4
# do_sample = True

# do_sample=False
# temperature=0

# def chunk_text(text, chunk_size=2000):
#     tokens = tokenizer.encode(text)
#     for i in range(0, len(tokens), chunk_size):
#         yield tokenizer.decode(tokens[i:i+chunk_size])

# summaries = []

# for chunk in chunk_text(text):
#     prompt = f"请总结以下内容：\n{chunk}"
#     inputs = tokenizer(prompt, return_tensors="pt").to(model.device)
#     outputs = model.generate(**inputs, max_new_tokens=300)
#     summaries.append(tokenizer.decode(outputs[0], skip_special_tokens=True))

# final_prompt = "请综合以下摘要，生成最终总结：\n" + "\n".join(summaries)

# | 参数                 | 作用             | 你的设置效果             |
# | -------------------- | ----------------| ------------------------|
# | `**inputs`           | 输入 prompt     | 从文本生成摘要            |
# | `max_new_tokens=800` | 限制生成长度     | 摘要不截断               |
# | `temperature=0.3`    | 控制随机性       | 输出稳定、逻辑清晰        |
# | `top_p=0.9`          | 核采样多样性     | 避免模型只选最可能 token  |
# | `do_sample=True`     | 是否随机采样     | 输出有轻微变化，更自然     |
