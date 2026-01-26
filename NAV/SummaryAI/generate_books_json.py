import os
import json

# Paths (adjust if needed)
EPUB_FOLDER = "epub"
SUMMARY_FOLDER = "summary"
OUTPUT_JSON = "books.json"

books = []

for epub_file in os.listdir(EPUB_FOLDER):
    if epub_file.lower().endswith(".epub"):
        title = os.path.splitext(epub_file)[0]
        epub_path = f"{EPUB_FOLDER}/{epub_file}"
        summary_file = f"summary_result_{title}.txt"
        summary_path = os.path.join(SUMMARY_FOLDER, summary_file)
        
        book = {
            "title": title,
            "epubPath": epub_path.replace("\\", "/")
        }

        if os.path.exists(summary_path):
            book["summaryPath"] = summary_path.replace("\\", "/")
        else:
            book["summaryPath"] = None

        books.append(book)

# Save JSON for the frontend
with open(OUTPUT_JSON, "w", encoding="utf-8") as f:
    json.dump(books, f, ensure_ascii=False, indent=2)

print(f"Generated {OUTPUT_JSON} with {len(books)} books.")
