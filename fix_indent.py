#!/usr/bin/env python3
"""Fix indentation of the workshop-details block that was shifted during the swap."""
import os, re

files = [f"workshop-0{i}.html" for i in range(1, 9)]
base = os.path.dirname(os.path.abspath(__file__))

for fname in files:
    path = os.path.join(base, fname)
    with open(path, "r", encoding="utf-8") as f:
        html = f.read()

    # Ensure the details block starts with 4-space indent on the same level as other elements
    fixed = html.replace(
        '\n<div class="workshop-details">',
        '\n    <div class="workshop-details">'
    )

    if fixed != html:
        with open(path, "w", encoding="utf-8") as f:
            f.write(fixed)
        print(f"  ✓ Fixed indent in {fname}")
    else:
        print(f"  — No indent fix needed in {fname}")

print("Done.")
