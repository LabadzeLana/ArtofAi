import re

details_map = {
    "workshop-01.html": {
        "tag": "Foundations",
        "date": "September 17, 2026",
        "time": "10:30 AM (CEST)"
    },
    "workshop-02.html": {
        "tag": "Critical Thinking",
        "date": "September 23, 2026",
        "time": "10:30 AM (CEST)"
    },
    "workshop-03.html": {
        "tag": "Creative Tools",
        "date": "September 22, 2026",
        "time": "10:30 AM (CEST)"
    },
    "workshop-04.html": {
        "tag": "Applied AI",
        "date": "September 25, 2026",
        "time": "10:30 AM (CEST)"
    },
    "workshop-05.html": {
        "tag": "Applied AI",
        "date": "September 18, 2026",
        "time": "10:30 AM (CEST)"
    },
    "workshop-06.html": {
        "tag": "App Development",
        "date": "Date TBA",
        "time": "Time TBA"
    },
    "workshop-07.html": {
        "tag": "Applied AI",
        "date": "September 28, 2026",
        "time": "10:30 AM (CEST)"
    },
    "workshop-08.html": {
        "tag": "Applied AI",
        "date": "September 21, 2026",
        "time": "10:30 AM (CEST)"
    }
}

def get_details_html(info):
    return f"""<div class="workshop-details">
            <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Online via Google Meet</span>
            <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>2 Hours</span>
            <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>{info['date']}</span>
            <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>{info['time']}</span>
          </div>"""

def get_details_html_page(info):
    return f"""<div class="workshop-details">
      <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Online via Google Meet</span>
      <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>2 Hours</span>
      <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>{info['date']}</span>
      <span class="wd-pill"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>{info['time']}</span>
    </div>"""

# 1. Update index.html
with open('/Users/geolab/Desktop/ArtofAi/index.html', 'r', encoding='utf-8') as f:
    index_content = f.read()

for ws_file, info in details_map.items():
    # Find the link block for this workshop and replace the tag within it
    pattern = rf'(<a href="{ws_file}" class="workshop-item reveal">.*?)(<span class="workshop-tag">{info["tag"]}</span>)'
    
    def replacer(match):
        return match.group(1) + get_details_html(info)
        
    index_content = re.sub(pattern, replacer, index_content, flags=re.DOTALL)

with open('/Users/geolab/Desktop/ArtofAi/index.html', 'w', encoding='utf-8') as f:
    f.write(index_content)
print("Updated index.html")

# 2. Update workshop-*.html pages
for ws_file, info in details_map.items():
    fpath = f'/Users/geolab/Desktop/ArtofAi/{ws_file}'
    with open(fpath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Inject CSS style if not already present
    css_to_add = """    .workshop-details {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-bottom: 1.5rem;
    }

    .workshop-details .wd-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      font-size: 0.65rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--red);
      background: rgba(232, 25, 10, 0.07);
      padding: 0.3rem 0.7rem;
      white-space: nowrap;
    }

    .workshop-details .wd-pill svg {
      flex-shrink: 0;
      opacity: 0.85;
    }"""
    
    # Check if workshop-details is in style block
    if ".workshop-details" not in content:
        # replace the workshop-tag CSS with it
        old_tag_css = """    .workshop-tag {
      display: inline-block;
      font-size: 0.65rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--red);
      background: rgba(232,25,10,0.07);
      padding: 0.3rem 0.8rem;
      margin-bottom: 1.5rem;
    }"""
        old_tag_css_variant = """    .workshop-tag {
      display: inline-block;
      font-size: 0.65rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--red);
      background: rgba(232,25,10,0.07);
      padding: 0.3rem 0.8rem;
      margin-bottom: 1.5rem;
    }"""
        
        # Let's find workshop-tag in CSS and replace it
        content = re.sub(r'\.workshop-tag\s*\{.*?\}', css_to_add, content, flags=re.DOTALL)
        
    # Replace the HTML tag
    old_tag_html = f'<span class="workshop-tag">{info["tag"]}</span>'
    content = content.replace(old_tag_html, get_details_html_page(info))
    
    with open(fpath, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f"Updated {ws_file}")
