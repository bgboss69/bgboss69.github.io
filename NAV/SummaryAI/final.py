# pip install tiktoken EbookLib beautifulsoup4 lxml
from ebooklib import epub
from bs4 import BeautifulSoup
import tiktoken
import os
from transformers import AutoTokenizer, AutoModelForCausalLM
import torch
import re

# =========================
# Input EPUB
# =========================
epub_file = r"C:\Users\KaiYuanCHING\Desktop\python\SummaryAI\epud\钱从哪里来.epub"
epub_name = os.path.splitext(os.path.basename(epub_file))[0]  # 

# # =========================
# # Extract EPUB items
# # =========================
def extract_items_from_epub(epub_file, epub_name):
    book = epub.read_epub(epub_file)
    output_dir = os.path.join("output_items", epub_name)

    if not os.path.exists(output_dir):
        os.makedirs(output_dir)

    # GPT-3.5 / GPT-4 token encoding
    encoding = tiktoken.get_encoding("cl100k_base")

    for idx, item in enumerate(book.get_items()):
        if item.get_type() == 9:  # ITEM_DOCUMENT
            soup = BeautifulSoup(item.get_body_content(), "lxml")
            text = soup.get_text().strip()
            if not text:
                continue

            tokens = encoding.encode(text)
            token_count = len(tokens)

            num_str = f"{idx + 1:02}"
            filename = f"{output_dir}/item_{num_str}_tokens_{token_count}.txt"
            with open(filename, "w", encoding="utf-8") as f:
                f.write(text)

            print(f"已保存 item {num_str} 到文件: {filename} (Token 数量: {token_count})")

extract_items_from_epub(epub_file, epub_name)


# def extract_chapters_from_ops(ops_dir, book_name):
#     output_dir = os.path.join("output_items", book_name)
#     os.makedirs(output_dir, exist_ok=True)

#     encoding = tiktoken.get_encoding("cl100k_base")

#     # 找 chapter 文件
#     chapter_files = [
#         f for f in os.listdir(ops_dir)
#         if re.match(r"chapter\d+\.html", f)
#     ]

#     if not chapter_files:
#         print("❌ OPS 目录下未找到 chapter 文件")
#         return

#     # 按章节号排序
#     chapter_files.sort(
#         key=lambda x: int(re.search(r"\d+", x).group())
#     )

#     for idx, filename in enumerate(chapter_files):
#         path = os.path.join(ops_dir, filename)

#         with open(path, "r", encoding="utf-8", errors="ignore") as f:
#             html = f.read()

#         soup = BeautifulSoup(html, "lxml")
#         text = soup.get_text(separator="\n", strip=True)

#         if not text:
#             continue

#         tokens = encoding.encode(text)
#         token_count = len(tokens)

#         num_str = f"{idx + 1:02}"
#         out_file = os.path.join(
#             output_dir,
#             f"chapter_{num_str}_tokens_{token_count}.txt"
#         )

#         with open(out_file, "w", encoding="utf-8") as f:
#             f.write(text)

#         print(f"✅ chapter {num_str} 保存成功 ({token_count} tokens)")

# ops_dir = r"C:\Users\KaiYuanCHING\Desktop\python\SummaryAI\就做赚钱的傻瓜 简单实用的傻瓜炒股法-宋建文\OPS"
# book_name = "就做赚钱的傻瓜"

# extract_chapters_from_ops(ops_dir, book_name)
# =========================
# Model config
# =========================
model_name = "Qwen/Qwen2.5-1.5B-Instruct"
tokenizer = AutoTokenizer.from_pretrained(model_name, trust_remote_code=True)
model = AutoModelForCausalLM.from_pretrained(
    model_name,
    trust_remote_code=True,
    device_map="cpu",
)
model.eval()
torch.set_num_threads(8)

# =========================
# Paths
# =========================
folder_path = os.path.join("output_items", epub_name)
output_file = f"C:\\Users\\KaiYuanCHING\\Desktop\\python\\SummaryAI\\summary\\summary_result_{epub_name}.txt"

# =========================
# Prompt config
# =========================
SYSTEM_PROMPT = (
    "你是一个善于总结教材和知识点的助手，"
    "你的回答必须简洁、结构化，并使用 bullet point。"
)

USER_PROMPT_TEMPLATE = (
    "请阅读以下文档内容，并完成总结：\n\n"
    "要求：\n"
    "1. 只输出重点内容\n"
    "2. 使用 bullet point(每一行以“- ”开头）\n"
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
        {"role": "user", "content": USER_PROMPT_TEMPLATE + text},
    ]

    input_ids = tokenizer.apply_chat_template(
        messages,
        tokenize=True,
        add_generation_prompt=True,
        truncation=True,
        max_length=tokenizer.model_max_length,
        return_tensors="pt",
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

        with torch.inference_mode():
            outputs = model.generate(
                input_ids=input_ids,
                do_sample=False,
                repetition_penalty=1.15,
                max_new_tokens=max(200, token_count // 8),
                eos_token_id=tokenizer.eos_token_id,
                pad_token_id=tokenizer.eos_token_id,
            )

        generated_tokens = outputs[0][input_ids.shape[1] :]
        summary = tokenizer.decode(generated_tokens, skip_special_tokens=True).strip()

        out_f.write("\n" + "=" * 60 + "\n")
        out_f.write(f"File: {filename}\n")
        out_f.write("=" * 60 + "\n")
        out_f.write(summary + "\n")

        print(f"✔ Summarized: {filename}")

print(f"✅ All summaries saved to {output_file}")
