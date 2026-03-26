<?php 
  $pageTitle = "Nick Astamidze — The ART of Using AI";
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
    
    .profile-section {
      flex: 1;
      display: grid;
      grid-template-columns: 1fr 1.2fr;
      align-items: center;
      padding: 10rem 4rem 6rem;
      gap: 5rem;
      max-width: 1400px;
      margin: 0 auto;
    }
    .profile-image-wrap {
      position: relative;
      aspect-ratio: 3 / 4;
      overflow: hidden;
      max-width: 500px;
      margin-left: auto;
    }
    .profile-image-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center top;
      display: block;
      filter: grayscale(15%);
    }
    .profile-image-wrap::before {
      content: '';
      position: absolute;
      inset: -1px;
      border: 1px solid rgba(232,25,10,0.3);
      pointer-events: none;
      z-index: 2;
    }
    
    .profile-text {
      max-width: 600px;
    }
    .profile-eyebrow {
      font-size: 0.72rem;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--grey);
      margin-bottom: 2rem;
      display: flex; align-items: center; gap: 1rem;
    }
    .profile-eyebrow::before {
      content: '';
      display: inline-block; width: 2rem; height: 1px;
      background: var(--red);
    }
    .profile-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(3.5rem, 6vw, 6rem);
      line-height: 0.95;
      letter-spacing: 0.02em;
      margin-bottom: 0.5rem;
    }
    .profile-role {
      font-size: 0.85rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--red);
      margin-bottom: 2.5rem;
      font-weight: 500;
    }
    
    .profile-bio {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #444;
      margin-bottom: 3.5rem;
      white-space: pre-line;
    }


    .profile-cta {
      display: inline-flex; align-items: center; gap: 1rem;
      background: var(--black);
      color: var(--white);
      padding: 1rem 2.2rem;
      font-size: 0.78rem;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      text-decoration: none;
      transition: background 0.3s, gap 0.3s;
    }
    .profile-cta:hover { background: var(--red); gap: 1.6rem; }
    .profile-cta-arrow { font-size: 1rem; }
    
    /* Footer styles to match the main page */
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
      .profile-section { 
        grid-template-columns: 1fr; 
        padding: 8rem 2rem 4rem; 
        text-align: center; 
        gap: 3rem;
      }
      .profile-image-wrap { margin: 0 auto; width: 100%; max-width: 400px; }
      .profile-eyebrow { justify-content: center; }
      .profile-bio { margin-left: auto; margin-right: auto; }
      footer { flex-direction: column; align-items: flex-start; padding: 3rem 2rem; }
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

  <section class="profile-section">
    <div class="profile-image-wrap">
      <!-- Fallback image logic handled with onerror -->
      <img src="Lecturers/Nick Astamidze.jpeg" alt="Nick Astamidze" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 400 533\'%3E%3Crect width=\'100%25\' height=\'100%25\' fill=\'%23ece9e3\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-family=\'Georgia,serif\' font-weight=\'bold\' font-size=\'72\' fill=\'%23b0aba3\'%3ENA%3C/text%3E%3C/svg%3E'" />
    </div>
    <div class="profile-text">
      <div class="profile-eyebrow">Lecturer Profile</div>
      <h1 class="profile-title">Nick Astamidze</h1>
      <div class="profile-role">Senior Unity Developer</div>
      <div class="profile-bio">Nick Astamidze is a Senior Unity Developer with over 10 years of experience building mobile and VR games and interactive applications. Throughout his career, he has contributed to projects reaching millions of users and worked with leading companies in the gaming industry, including Huuuge Games, Moon Active, and Homa Games.

Alongside his professional work, Nick has been actively involved in education and mentoring. In Georgia, he taught game development at Geolab and Georgian Institute of Public Affairs, helping students gain practical skills in game development and software engineering. After moving to Austria, he continued supporting the next generation of developers by mentoring STEM students interested in technology and game development.

Nick has also participated in and organized hackathons under Georgia's Innovation and Technology Agency, contributing to the growth of the local tech and startup ecosystem. In addition, he has taken part in entrepreneurial training programs and collaborated on early-stage startup ideas, gaining experience in product thinking and experimentation.

Currently, he is focused on adopting AI to improve development workflows, automate processes, and accelerate the creation of interactive products.</div>
    </div>
  </section>
  
  <?php include "footer.php"; ?>
</body>
</html>
