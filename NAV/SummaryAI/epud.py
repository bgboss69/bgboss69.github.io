# pip install tiktoken EbookLib beautifulsoup4 lxml
from ebooklib import epub
from bs4 import BeautifulSoup
import tiktoken
import os


# 提取 EPUB 中每个 item 的文本并保存
def extract_items_from_epub(epub_file):
    book = epub.read_epub(epub_file)
    output_dir = 'output_items'

    if not os.path.exists(output_dir):
        os.makedirs(output_dir)

    # GPT-3.5 / GPT-4 使用的编码
    encoding = tiktoken.get_encoding("cl100k_base")

    for idx, item in enumerate(book.get_items()):
        if item.get_type() == 9:  # ITEM_DOCUMENT
            soup = BeautifulSoup(item.get_body_content(), 'lxml')
            text = soup.get_text().strip()
            if not text:
                continue

            # 计算 token 数量
            tokens = encoding.encode(text)
            token_count = len(tokens)

            # 保存文件
            num_str = f"{idx + 1:02}"
            filename = f"{output_dir}/item_{num_str}_tokens_{token_count}.txt"
            with open(filename, 'w', encoding='utf-8') as f:
                f.write(text)

            print(f"已保存 item {num_str} 到文件: {filename} (Token 数量: {token_count})")

epub_file = r'C:\Users\KaiYuanCHING\Desktop\python\SummaryAI\懒汉把妹.epub'
extract_items_from_epub(epub_file)
