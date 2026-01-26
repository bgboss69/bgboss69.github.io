from transformers import AutoTokenizer, AutoModelForCausalLM
import torch
import os

# =========================
# Model config
# =========================
model_name = "Qwen/Qwen2.5-1.5B-Instruct"

tokenizer = AutoTokenizer.from_pretrained(
    model_name,
    trust_remote_code=True
)

model = AutoModelForCausalLM.from_pretrained(
    model_name,
    trust_remote_code=True,
    device_map="cpu"   # CPU only
)

model.eval()
torch.set_num_threads(8)

# =========================
# Paths
# =========================
folder_path = r"C:\Users\KaiYuanCHING\Desktop\python\SummaryAI\output_items"
output_file = r"C:\Users\KaiYuanCHING\Desktop\python\SummaryAI\summary_result.txt"

# =========================
# Prompt（强制 bullet point）
# =========================
SYSTEM_PROMPT = (
    "你是一个善于总结教材和知识点的助手，"
    "你的回答必须简洁、结构化，并使用 bullet point。"
)

USER_PROMPT_TEMPLATE = (
    "请阅读以下文档内容，并完成总结：\n\n"
    "要求：\n"
    "1. 只输出重点内容\n"
    "2. 使用 bullet point（每一行以“- ”开头）\n"
    "3. 不要复述原文句子\n"
    "4. 不要加入无关解释\n\n"
    "文档内容如下：\n"
)

# =========================
# Build chat input
# =========================
def build_chat_input(text: str):
    messages = [
        {"role": "system", "content": SYSTEM_PROMPT},
        {"role": "user", "content": USER_PROMPT_TEMPLATE + text}
    ]

    input_ids = tokenizer.apply_chat_template(
        messages,
        tokenize=True,
        add_generation_prompt=True,
        truncation=True,
        max_length=tokenizer.model_max_length,
        return_tensors="pt"
    )
    return input_ids

# =========================
# Summarization loop
# =========================
with open(output_file, "w", encoding="utf-8") as out_f:
    for filename in sorted(os.listdir(folder_path)):
        if not filename.endswith(".txt"):
            continue

        file_path = os.path.join(folder_path, filename)
        with open(file_path, "r", encoding="utf-8") as f:
            text = f.read().strip()

        if not text:
            print(f"⚠ Skipped empty file: {filename}")
            continue

        token_count = len(tokenizer.encode(text))
        input_ids = build_chat_input(text).to(model.device)

        # =========================
        # Generate (稳定 / 教材风格)
        # =========================
        with torch.inference_mode():
            outputs = model.generate(
                input_ids=input_ids,
                do_sample=False,               # 贪婪解码，稳
                repetition_penalty=1.15,       # 防止重复
                max_new_tokens=min(500, max(200, token_count // 6)),
                eos_token_id=tokenizer.eos_token_id,
                pad_token_id=tokenizer.eos_token_id
            )

        generated_tokens = outputs[0][input_ids.shape[1]:]
        summary = tokenizer.decode(
            generated_tokens,
            skip_special_tokens=True
        ).strip()

        # =========================
        # Write result
        # =========================
        out_f.write("\n" + "=" * 60 + "\n")
        out_f.write(f"File: {filename}\n")
        out_f.write("=" * 60 + "\n")
        out_f.write(summary + "\n")

        print(f"✔ Summarized: {filename}")

print("✅ All summaries saved to summary_result.txt")
