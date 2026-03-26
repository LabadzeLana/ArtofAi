<?php 
  $pageTitle = "Workshop 03: The Art of the Prompt — The ART of Using AI";
  include "header.php"; 
?>
  <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
      --red: #E8190A;
      --black: #0c0c0c;
      --white: #f5f3ef;
      --grey: #b0aba3;
      --light: #ece9e3;
    }
    body {
      background: var(--white);
      color: var(--black);
      font-family: 'DM Sans', sans-serif;
      font-weight: 300;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 100;
      display: flex; justify-content: space-between; align-items: center;
      padding: 1.4rem 4rem;
      background: rgba(245,243,239,0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(0,0,0,0.08);
    }
    .nav-logo {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.3rem;
      letter-spacing: 0.15em;
      color: var(--black);
      text-decoration: none;
    }
    .nav-logo span { color: var(--red); }
    .nav-links { display: flex; gap: 2.5rem; list-style: none; }
    .nav-links a {
      font-size: 0.78rem;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--black);
      text-decoration: none;
      position: relative;
      padding-bottom: 2px;
      font-weight: 500;
    }
    .nav-links a::after {
      content: '';
      position: absolute; bottom: 0; left: 0;
      width: 0; height: 1px;
      background: var(--red);
      transition: width 0.3s ease;
    }
    .nav-links a:hover::after { width: 100%; }
    
    .workshop-section {
      flex: 1;
      padding: 10rem 4rem 6rem;
      max-width: 1000px;
      margin: 0 auto;
    }
    .workshop-eyebrow {
      font-size: 0.72rem;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--grey);
      margin-bottom: 2rem;
      display: flex; align-items: center; gap: 1rem;
    }
    .workshop-eyebrow::before {
      content: '';
      display: inline-block; width: 2rem; height: 1px;
      background: var(--red);
    }
    .workshop-tag {
      display: inline-block;
      font-size: 0.65rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--red);
      background: rgba(232,25,10,0.07);
      padding: 0.3rem 0.8rem;
      margin-bottom: 1.5rem;
    }
    .workshop-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(3rem, 6vw, 5rem);
      line-height: 0.95;
      letter-spacing: 0.02em;
      margin-bottom: 1.5rem;
    }
    .workshop-lecturer {
      font-size: 1.1rem;
      font-weight: 400;
      color: var(--black);
      margin-bottom: 2.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .workshop-lecturer span { color: var(--red); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; }
    
    .workshop-description {
      font-size: 1.15rem;
      line-height: 1.8;
      color: #444;
      margin-bottom: 3.5rem;
      white-space: pre-line;
    }

    
    .cta-group {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
    }
    .cta-btn {
      display: inline-flex; align-items: center; gap: 1rem;
      padding: 1rem 2.2rem;
      font-size: 0.78rem;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      text-decoration: none;
      transition: all 0.3s;
    }
    .cta-primary {
      background: var(--red);
      color: var(--white);
    }
    .cta-primary:hover { background: var(--black); gap: 1.6rem; }
    .cta-secondary {
      background: var(--black);
      color: var(--white);
    }
    .cta-secondary:hover { background: var(--red); gap: 1.6rem; }
    .cta-arrow { font-size: 1rem; }
    
    /* ── FOOTER ── */
    footer {
      background: var(--black);
      color: var(--white);
      padding: 4rem;
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      grid-template-rows: auto auto;
      gap: 2rem 3rem;
      align-items: start;
    }

    .footer-brand {}

    .footer-logo {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.6rem;
      letter-spacing: 0.1em;
    }

    .footer-logo span {
      color: var(--red);
    }

    .footer-tagline {
      font-size: 0.78rem;
      color: rgba(255, 255, 255, 0.4);
      letter-spacing: 0.08em;
      margin-top: 0.5rem;
      line-height: 1.5;
    }

    .footer-contact {}

    .footer-contact-label {
      font-size: 0.65rem;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--red);
      margin-bottom: 0.7rem;
    }

    .footer-email {
      color: rgba(255, 255, 255, 0.55);
      text-decoration: none;
      font-size: 0.88rem;
      letter-spacing: 0.03em;
      transition: color 0.2s;
    }

    .footer-email:hover {
      color: var(--red);
    }

    .footer-social {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .social-link {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      color: rgba(255, 255, 255, 0.55);
      text-decoration: none;
      font-size: 0.82rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      transition: color 0.2s, gap 0.2s;
    }

    .social-link:hover {
      color: var(--red);
      gap: 0.9rem;
    }

    .footer-bottom {
      grid-column: 1 / -1;
      padding-top: 2rem;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      font-size: 0.7rem;
      color: rgba(255, 255, 255, 0.25);
      letter-spacing: 0.06em;
    }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .reveal {
      opacity: 1;
      transform: translateY(0);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .js-ready .reveal {
      opacity: 0;
      transform: translateY(24px);
    }

    .js-ready .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
      nav { padding: 1.2rem 2rem; }
      .workshop-section { padding: 8rem 2rem 4rem; }
      footer { grid-template-columns: 1fr; padding: 3rem 2rem; }
    }
  </style>
</head>
<body>
  <nav id="nav">
    <a href="./" class="nav-logo">Geo<span>Lab</span></a>
    <ul class="nav-links">
      <li><a href="./">← Back to Main Page</a></li>
    </ul>
  </nav>

  <section class="workshop-section">
    <div class="workshop-eyebrow">Workshop 03</div>
    <span class="workshop-tag">Creative Tools</span>
    <h1 class="workshop-title">Beginner Course: AI Image Generation with Midjourney</h1>
    <div class="workshop-lecturer">
      <span>Lecturer :</span> <a href="khatia-nodia" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; border-bottom: 1px solid var(--red);">Khatia Nodia</a>
    </div>
    <div class="workshop-description">
      This introductory course provides a practical overview of AI image generation using Midjourney. Participants learn how to structure effective prompts, generate images, and guide visual outcomes using references and parameters. The course focuses on hands-on experimentation and understanding how to communicate visual ideas to AI tools.
While Midjourney is the main tool used, the prompting principles covered in this session can be applied across many AI image generation platforms.

Topics Covered:
• Introduction to AI image generation
• How prompting works and how to structure effective prompts
• Generating and iterating images in Midjourney
• Using image references to guide visual style and composition
• Understanding and applying key parameters
• Exploring Midjourney features such as Blend and Describe
• Tips for improving results and creative experimentation

Tools: Midjourney, Discord (Midjourney interface)
    </div>
    <div class="cta-group">
      <a href="https://forms.gle/LBfuTBLVwV99jnQ76" target="_blank" rel="noopener noreferrer" class="cta-btn cta-primary">
        Register for the Workshop <span class="cta-arrow">→</span>
      </a>
    </div>
  </section>
  
  <?php include "footer.php"; ?>
</body>
</html>
