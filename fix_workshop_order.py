#!/usr/bin/env python3
"""
Move workshop-details pills to appear AFTER workshop-title in all workshop detail pages.
Also adjusts the CSS margins accordingly.
"""
import re
import os

files = [
    "workshop-01.html",
    "workshop-02.html",
    "workshop-03.html",
    "workshop-04.html",
    "workshop-05.html",
    "workshop-06.html",
    "workshop-07.html",
    "workshop-08.html",
]

base = os.path.dirname(os.path.abspath(__file__))

for fname in files:
    path = os.path.join(base, fname)
    with open(path, "r", encoding="utf-8") as f:
        html = f.read()

    original = html

    # ── 1. Move workshop-details block AFTER h1.workshop-title ──────────────
    # Pattern: capture (details block)(h1 title line)
    # Replace with: (h1 title line)(details block)
    pattern = re.compile(
        r'(<div class="workshop-details">.*?</div>)\s*\n(\s*<h1 class="workshop-title">.*?</h1>)',
        re.DOTALL
    )

    def swap(m):
        details_block = m.group(1)
        title_line    = m.group(2)
        return title_line + "\n" + details_block

    html, count = pattern.subn(swap, html)

    if count == 0:
        print(f"  ⚠  No swap made in {fname} — pattern not found.")
    else:
        print(f"  ✓  Swapped in {fname}")

    # ── 2. CSS: add margin-top to .workshop-details, remove margin-bottom ────
    html = html.replace(
        ".workshop-details {\n      display: flex;\n      flex-wrap: wrap;\n      gap: 0.5rem;\n      margin-bottom: 1.5rem;\n    }",
        ".workshop-details {\n      display: flex;\n      flex-wrap: wrap;\n      gap: 0.5rem;\n      margin-top: 0.6rem;\n      margin-bottom: 1.5rem;\n    }"
    )

    # ── 3. CSS: remove margin-bottom from .workshop-title ───────────────────
    html = html.replace(
        ".workshop-title {\n      font-family: 'Bebas Neue', sans-serif;\n      font-size: clamp(3rem, 6vw, 5rem);\n      line-height: 0.95;\n      letter-spacing: 0.02em;\n      margin-bottom: 1.5rem;\n    }",
        ".workshop-title {\n      font-family: 'Bebas Neue', sans-serif;\n      font-size: clamp(3rem, 6vw, 5rem);\n      line-height: 0.95;\n      letter-spacing: 0.02em;\n      margin-bottom: 0;\n    }"
    )

    if html != original:
        with open(path, "w", encoding="utf-8") as f:
            f.write(html)
        print(f"  💾 Saved {fname}")
    else:
        print(f"  ⚠  No changes written to {fname}")

print("\nDone.")
