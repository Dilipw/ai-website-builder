<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Business Website</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&family=Bebas+Neue&family=DM+Serif+Display:ital@0;1&family=Syne:wght@400;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap"
            rel="stylesheet">

        <style>
            /* ─── RESET ─── */
            *,
            *::before,
            *::after {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            html {
                scroll-behavior: smooth;
            }

            /* ─── LOADER ─── */
            #loader {
                position: fixed;
                inset: 0;
                z-index: 9999;
                background: #08080f;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 1.5rem;
                transition: opacity 0.5s ease, visibility 0.5s ease;
            }

            #loader.hidden {
                opacity: 0;
                visibility: hidden;
            }

            .loader-bar {
                width: 200px;
                height: 2px;
                background: rgba(255, 255, 255, 0.08);
                border-radius: 2px;
                overflow: hidden;
            }

            .loader-bar-fill {
                height: 100%;
                width: 0%;
                border-radius: 2px;
                animation: loadBar 1.2s ease forwards;
                background: #fff;
            }

            @keyframes loadBar {
                to {
                    width: 100%;
                }
            }

            .loader-label {
                font-family: 'DM Sans', sans-serif;
                font-size: 0.7rem;
                letter-spacing: 0.3em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, 0.3);
            }

            /* ─── ANIMATIONS ─── */
            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(28px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes scaleUp {
                from {
                    opacity: 0;
                    transform: scale(0.94);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .u-fade-up {
                animation: fadeUp 0.65s cubic-bezier(.22, 1, .36, 1) both;
            }

            .u-fade-in {
                animation: fadeIn 0.65s ease both;
            }

            .u-scale-up {
                animation: scaleUp 0.65s cubic-bezier(.22, 1, .36, 1) both;
            }

            .d1 {
                animation-delay: .1s;
            }

            .d2 {
                animation-delay: .22s;
            }

            .d3 {
                animation-delay: .34s;
            }

            .d4 {
                animation-delay: .46s;
            }

            .d5 {
                animation-delay: .58s;
            }

            /* ─── LAYOUT HELPERS ─── */
            .container {
                max-width: 1100px;
                margin: 0 auto;
                padding: 0 1.5rem;
            }

            .grid-2 {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1.25rem;
            }

            .grid-2-fixed {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 4rem;
                align-items: center;
            }

            @media (max-width: 768px) {
                .grid-2-fixed {
                    grid-template-columns: 1fr;
                    gap: 2.5rem;
                }

                .hide-mobile {
                    display: none !important;
                }

                .nav-links a:first-child {
                    margin-left: 0;
                }
            }

            @media (max-width: 520px) {
                .nav-links {
                    display: none;
                }
            }

            /* ══════════════════════════════════
           THEME: RESTAURANT
        ══════════════════════════════════ */
            body.t-restaurant {
                --p: #c8360b;
                --a: #e8820c;
                --dk: #1c0f06;
                font-family: 'DM Sans', sans-serif;
                background: #faf7f2;
                color: #2d1a0e;
            }

            body.t-restaurant nav {
                background: var(--dk);
                padding: 1.1rem 2rem;
                position: sticky;
                top: 0;
                z-index: 200;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            body.t-restaurant .nav-brand {
                font-family: 'Playfair Display', serif;
                font-size: 1.35rem;
                font-weight: 700;
                color: var(--a);
                letter-spacing: .03em;
            }

            body.t-restaurant .nav-links a {
                color: rgba(255, 255, 255, .55);
                text-decoration: none;
                font-size: .78rem;
                letter-spacing: .12em;
                text-transform: uppercase;
                margin-left: 2rem;
                transition: color .2s;
            }

            body.t-restaurant .nav-links a:hover {
                color: var(--a);
            }

            body.t-restaurant #hero {
                background: var(--dk);
                min-height: 88vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 5rem 1.5rem;
                position: relative;
                overflow: hidden;
            }

            body.t-restaurant #hero::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(ellipse 90% 60% at 50% 80%, rgba(200, 54, 11, .28) 0%, transparent 65%);
            }

            body.t-restaurant .hero-tag {
                display: inline-block;
                padding: .35rem 1rem;
                border: 1px solid rgba(232, 130, 12, .4);
                color: var(--a);
                font-size: .7rem;
                letter-spacing: .25em;
                text-transform: uppercase;
                margin-bottom: 1.5rem;
                position: relative;
            }

            body.t-restaurant #hero h1 {
                font-family: 'Playfair Display', serif;
                font-size: clamp(2.8rem, 7vw, 6rem);
                font-weight: 900;
                color: #fff;
                line-height: 1.05;
                position: relative;
            }

            body.t-restaurant #hero .tagline {
                font-family: 'Lora', serif;
                font-style: italic;
                color: var(--a);
                font-size: clamp(1rem, 2vw, 1.3rem);
                margin: 1rem 0 2.5rem;
                position: relative;
            }

            body.t-restaurant .btn-primary {
                background: var(--p);
                color: #fff;
                border: none;
                padding: .85rem 2.2rem;
                cursor: pointer;
                font-family: 'DM Sans', sans-serif;
                font-size: .88rem;
                font-weight: 600;
                letter-spacing: .08em;
                text-transform: uppercase;
                transition: all .2s;
                position: relative;
            }

            body.t-restaurant .btn-primary:hover {
                background: #a82a08;
                transform: translateY(-2px);
                box-shadow: 0 8px 24px rgba(200, 54, 11, .4);
            }

            body.t-restaurant #about {
                padding: 7rem 1.5rem;
                background: #faf7f2;
            }

            body.t-restaurant .about-visual {
                aspect-ratio: 4/5;
                background: linear-gradient(145deg, var(--p), #7a1500);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 7rem;
                box-shadow: 16px 16px 0 rgba(200, 54, 11, .15);
            }

            body.t-restaurant .section-eyebrow {
                font-size: .7rem;
                letter-spacing: .25em;
                text-transform: uppercase;
                color: var(--p);
                margin-bottom: .8rem;
                font-weight: 600;
            }

            body.t-restaurant .about-title {
                font-family: 'Playfair Display', serif;
                font-size: clamp(1.8rem, 4vw, 2.8rem);
                font-weight: 700;
                line-height: 1.2;
                margin-bottom: 1.2rem;
            }

            body.t-restaurant .rule {
                width: 3rem;
                height: 3px;
                background: var(--p);
                margin: 1.2rem 0 1.4rem;
            }

            body.t-restaurant .about-body {
                color: #7a5540;
                line-height: 1.85;
                font-size: .97rem;
            }

            body.t-restaurant #services-section {
                padding: 7rem 1.5rem;
                background: var(--dk);
            }

            body.t-restaurant .section-heading {
                font-family: 'Playfair Display', serif;
                font-size: clamp(1.8rem, 4vw, 2.6rem);
                color: #fff;
                text-align: center;
                margin-bottom: 3rem;
            }

            body.t-restaurant .service-card {
                background: rgba(255, 255, 255, .04);
                border: 1px solid rgba(200, 54, 11, .2);
                padding: 2rem 1.5rem;
                transition: all .25s;
                position: relative;
                overflow: hidden;
            }

            body.t-restaurant .service-card::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--a);
                transition: width .35s;
            }

            body.t-restaurant .service-card:hover {
                background: rgba(200, 54, 11, .07);
                transform: translateY(-4px);
            }

            body.t-restaurant .service-card:hover::after {
                width: 100%;
            }

            body.t-restaurant .s-icon {
                font-size: 2rem;
                margin-bottom: .8rem;
            }

            body.t-restaurant .s-name {
                color: #fff;
                font-weight: 600;
                font-size: 1.05rem;
                margin-bottom: .35rem;
            }

            body.t-restaurant .s-desc {
                color: rgba(255, 255, 255, .4);
                font-size: .83rem;
                line-height: 1.6;
            }

            body.t-restaurant #cta {
                padding: 7rem 1.5rem;
                background: var(--p);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            body.t-restaurant #cta::before {
                content: '';
                position: absolute;
                inset: 0;
                background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='0.04'%3E%3Cpath d='M0 20L20 0L40 20L20 40z'/%3E%3C/g%3E%3C/svg%3E");
            }

            body.t-restaurant #cta h2 {
                font-family: 'Playfair Display', serif;
                font-size: clamp(2rem, 5vw, 3rem);
                color: #fff;
                position: relative;
            }

            body.t-restaurant #cta p {
                color: rgba(255, 255, 255, .8);
                margin: .8rem 0 2rem;
                position: relative;
                font-size: .95rem;
            }

            body.t-restaurant #cta button {
                background: #fff;
                color: var(--p);
                border: none;
                padding: .9rem 2.5rem;
                font-weight: 700;
                letter-spacing: .08em;
                text-transform: uppercase;
                font-size: .85rem;
                cursor: pointer;
                transition: all .2s;
                position: relative;
            }

            body.t-restaurant #cta button:hover {
                transform: scale(1.04);
                box-shadow: 0 8px 28px rgba(0, 0, 0, .25);
            }

            body.t-restaurant footer {
                background: #0d0500;
                padding: 2rem;
                text-align: center;
                color: rgba(255, 255, 255, .22);
                font-size: .8rem;
                letter-spacing: .1em;
            }

            /* ══════════════════════════════════
           THEME: GYM
        ══════════════════════════════════ */
            body.t-gym {
                --p: #e8000d;
                --a: #ff3d47;
                --dk: #060606;
                --mid: #111;
                font-family: 'DM Sans', sans-serif;
                background: var(--dk);
                color: #f0f0f0;
            }

            body.t-gym nav {
                background: rgba(6, 6, 6, .97);
                backdrop-filter: blur(12px);
                padding: 1rem 2rem;
                position: sticky;
                top: 0;
                z-index: 200;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 2px solid var(--p);
            }

            body.t-gym .nav-brand {
                font-family: 'Bebas Neue', sans-serif;
                font-size: 1.6rem;
                color: #fff;
                letter-spacing: .12em;
            }

            body.t-gym .nav-brand span {
                color: var(--p);
            }

            body.t-gym .nav-links a {
                color: rgba(255, 255, 255, .45);
                text-decoration: none;
                font-size: .78rem;
                letter-spacing: .15em;
                text-transform: uppercase;
                margin-left: 2rem;
                font-weight: 600;
                transition: color .2s;
            }

            body.t-gym .nav-links a:hover {
                color: var(--p);
            }

            body.t-gym #hero {
                min-height: 90vh;
                background: var(--dk);
                display: flex;
                align-items: center;
                padding: 4rem 2rem;
                position: relative;
                overflow: hidden;
            }

            body.t-gym .hero-big-text {
                position: absolute;
                right: -2rem;
                top: 50%;
                transform: translateY(-50%);
                pointer-events: none;
                font-family: 'Bebas Neue', sans-serif;
                font-size: clamp(14rem, 28vw, 26rem);
                color: rgba(232, 0, 13, .04);
                line-height: 1;
                letter-spacing: -.02em;
                white-space: nowrap;
            }

            body.t-gym .hero-stripe {
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 5px;
                background: var(--p);
            }

            body.t-gym .hero-inner {
                max-width: 680px;
                padding-left: 2rem;
                position: relative;
                z-index: 2;
            }

            body.t-gym .hero-tag {
                font-size: .7rem;
                font-weight: 700;
                letter-spacing: .3em;
                text-transform: uppercase;
                color: var(--p);
                margin-bottom: 1rem;
                display: block;
            }

            body.t-gym #hero h1 {
                font-family: 'Bebas Neue', sans-serif;
                font-size: clamp(3.5rem, 9vw, 8rem);
                line-height: .92;
                color: #fff;
                letter-spacing: .03em;
                text-transform: uppercase;
            }

            body.t-gym #hero .tagline {
                color: rgba(240, 240, 240, .45);
                font-size: clamp(.9rem, 1.5vw, 1.1rem);
                margin: 1.2rem 0 2.2rem;
                letter-spacing: .08em;
                text-transform: uppercase;
            }

            body.t-gym .btn-primary {
                background: var(--p);
                color: #fff;
                border: none;
                padding: .9rem 2.4rem;
                cursor: pointer;
                font-family: 'DM Sans', sans-serif;
                font-size: .88rem;
                font-weight: 800;
                letter-spacing: .15em;
                text-transform: uppercase;
                transition: all .2s;
                position: relative;
                overflow: hidden;
            }

            body.t-gym .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(232, 0, 13, .5);
            }

            body.t-gym .hero-stats {
                display: flex;
                gap: 3rem;
                margin-top: 2.5rem;
                flex-wrap: wrap;
            }

            body.t-gym .stat-n {
                font-family: 'Bebas Neue', sans-serif;
                font-size: 2.8rem;
                color: var(--p);
                line-height: 1;
            }

            body.t-gym .stat-l {
                font-size: .68rem;
                letter-spacing: .2em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, .3);
                margin-top: .1rem;
            }

            body.t-gym #about {
                padding: 7rem 1.5rem;
                background: var(--mid);
            }

            body.t-gym .about-visual {
                aspect-ratio: 1;
                background: linear-gradient(135deg, var(--p), #6a0008);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 7rem;
                position: relative;
            }

            body.t-gym .about-badge {
                position: absolute;
                bottom: -1.2rem;
                right: -1.2rem;
                background: #fff;
                color: #000;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                font-family: 'Bebas Neue', sans-serif;
                font-size: 2rem;
                line-height: 1;
                box-shadow: 0 0 0 6px var(--mid);
            }

            body.t-gym .about-badge span {
                font-family: 'DM Sans', sans-serif;
                font-size: .55rem;
                letter-spacing: .1em;
                text-transform: uppercase;
            }

            body.t-gym .section-eyebrow {
                font-size: .7rem;
                letter-spacing: .25em;
                text-transform: uppercase;
                color: var(--p);
                margin-bottom: .8rem;
                font-weight: 700;
            }

            body.t-gym .about-title {
                font-family: 'Bebas Neue', sans-serif;
                font-size: clamp(2rem, 5vw, 3.5rem);
                line-height: 1.1;
                margin-bottom: 1rem;
                letter-spacing: .04em;
            }

            body.t-gym .rule {
                width: 3rem;
                height: 3px;
                background: var(--p);
                margin: 1rem 0 1.2rem;
            }

            body.t-gym .about-body {
                color: rgba(240, 240, 240, .45);
                line-height: 1.85;
                font-size: .95rem;
            }

            body.t-gym #services-section {
                padding: 7rem 1.5rem;
                background: var(--dk);
            }

            body.t-gym .section-heading {
                font-family: 'Bebas Neue', sans-serif;
                font-size: clamp(2rem, 5vw, 3.5rem);
                letter-spacing: .04em;
                color: #fff;
                text-align: center;
                margin-bottom: 3rem;
            }

            body.t-gym .service-card {
                background: var(--mid);
                border: 1px solid rgba(255, 255, 255, .05);
                padding: 1.8rem 1.5rem;
                transition: all .25s;
                position: relative;
                overflow: hidden;
            }

            body.t-gym .service-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 3px;
                height: 0;
                background: var(--p);
                transition: height .35s;
            }

            body.t-gym .service-card:hover::before {
                height: 100%;
            }

            body.t-gym .service-card:hover {
                border-color: rgba(232, 0, 13, .25);
                transform: translateX(4px);
            }

            body.t-gym .s-icon {
                font-size: 1.8rem;
                margin-bottom: .7rem;
            }

            body.t-gym .s-name {
                font-family: 'Bebas Neue', sans-serif;
                font-size: 1.4rem;
                letter-spacing: .05em;
                color: #fff;
                margin-bottom: .3rem;
            }

            body.t-gym .s-desc {
                color: rgba(255, 255, 255, .35);
                font-size: .82rem;
                line-height: 1.6;
            }

            body.t-gym #cta {
                padding: 7rem 1.5rem;
                background: var(--p);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            body.t-gym #cta::before {
                content: 'GO';
                position: absolute;
                font-family: 'Bebas Neue', sans-serif;
                font-size: 40vw;
                color: rgba(0, 0, 0, .08);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                pointer-events: none;
            }

            body.t-gym #cta h2 {
                font-family: 'Bebas Neue', sans-serif;
                font-size: clamp(2.5rem, 6vw, 4rem);
                color: #fff;
                letter-spacing: .04em;
                position: relative;
            }

            body.t-gym #cta p {
                color: rgba(255, 255, 255, .7);
                margin: .7rem 0 2rem;
                letter-spacing: .1em;
                text-transform: uppercase;
                font-size: .82rem;
                position: relative;
            }

            body.t-gym #cta button {
                background: #fff;
                color: var(--p);
                border: none;
                padding: .9rem 2.5rem;
                font-weight: 800;
                letter-spacing: .15em;
                text-transform: uppercase;
                font-size: .85rem;
                cursor: pointer;
                transition: all .2s;
                position: relative;
            }

            body.t-gym #cta button:hover {
                background: #000;
                color: #fff;
                transform: scale(1.04);
            }

            body.t-gym footer {
                background: #000;
                padding: 2rem;
                text-align: center;
                color: rgba(255, 255, 255, .18);
                font-size: .78rem;
                letter-spacing: .15em;
                text-transform: uppercase;
                border-top: 2px solid var(--p);
            }

            /* ══════════════════════════════════
           THEME: SALON
        ══════════════════════════════════ */
            body.t-salon {
                --p: #b5607c;
                --a: #e0a8b8;
                --dk: #1a0c12;
                font-family: 'DM Sans', sans-serif;
                background: #fdf8f9;
                color: #2e1420;
            }

            body.t-salon nav {
                background: rgba(253, 248, 249, .94);
                backdrop-filter: blur(16px);
                padding: 1.2rem 2rem;
                position: sticky;
                top: 0;
                z-index: 200;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid rgba(181, 96, 124, .15);
            }

            body.t-salon .nav-brand {
                font-family: 'DM Serif Display', serif;
                font-size: 1.4rem;
                color: var(--p);
                letter-spacing: .04em;
            }

            body.t-salon .nav-links a {
                color: #2e1420;
                text-decoration: none;
                font-size: .78rem;
                letter-spacing: .12em;
                text-transform: uppercase;
                margin-left: 2rem;
                opacity: .6;
                font-weight: 500;
                transition: opacity .2s, color .2s;
            }

            body.t-salon .nav-links a:hover {
                opacity: 1;
                color: var(--p);
            }

            body.t-salon #hero {
                min-height: 88vh;
                display: grid;
                grid-template-columns: 1fr 1fr;
                overflow: hidden;
            }

            @media(max-width:768px) {
                body.t-salon #hero {
                    grid-template-columns: 1fr;
                }
            }

            body.t-salon .hero-left {
                background: var(--dk);
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 5rem 3.5rem;
                position: relative;
            }

            body.t-salon .hero-left::after {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at 110% 0%, rgba(181, 96, 124, .25) 0%, transparent 55%);
            }

            body.t-salon .hero-right {
                background: linear-gradient(155deg, var(--p) 0%, #7a2840 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 10rem;
                position: relative;
                overflow: hidden;
            }

            body.t-salon .hero-right::before {
                content: '';
                position: absolute;
                inset: 0;
                background: repeating-linear-gradient(45deg, transparent, transparent 24px, rgba(255, 255, 255, .035) 24px, rgba(255, 255, 255, .035) 25px);
            }

            body.t-salon .hero-tag {
                font-size: .68rem;
                letter-spacing: .28em;
                text-transform: uppercase;
                color: var(--a);
                margin-bottom: 1.4rem;
                position: relative;
                z-index: 1;
            }

            body.t-salon #hero h1 {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(2.2rem, 5vw, 4rem);
                color: #fff;
                line-height: 1.1;
                position: relative;
                z-index: 1;
            }

            body.t-salon #hero .tagline {
                color: rgba(255, 255, 255, .55);
                font-size: .97rem;
                font-weight: 300;
                margin: 1rem 0 2.2rem;
                letter-spacing: .04em;
                position: relative;
                z-index: 1;
            }

            body.t-salon .btn-primary {
                display: inline-block;
                background: transparent;
                color: var(--a);
                border: 1px solid var(--p);
                padding: .8rem 2rem;
                cursor: pointer;
                font-family: 'DM Sans', sans-serif;
                font-size: .8rem;
                font-weight: 600;
                letter-spacing: .15em;
                text-transform: uppercase;
                transition: all .25s;
                position: relative;
                z-index: 1;
            }

            body.t-salon .btn-primary:hover {
                background: var(--p);
                color: #fff;
            }

            body.t-salon #about {
                padding: 7rem 1.5rem;
                background: #fdf8f9;
            }

            body.t-salon .about-visual {
                aspect-ratio: 3/4;
                background: linear-gradient(155deg, var(--a) 0%, var(--p) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 7rem;
                position: relative;
            }

            body.t-salon .about-visual::before {
                content: '';
                position: absolute;
                top: -1.2rem;
                left: -1.2rem;
                width: 55%;
                height: 55%;
                border: 1.5px solid var(--p);
                pointer-events: none;
            }

            body.t-salon .section-eyebrow {
                font-size: .68rem;
                letter-spacing: .28em;
                text-transform: uppercase;
                color: var(--p);
                margin-bottom: .8rem;
                font-weight: 600;
            }

            body.t-salon .about-title {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(1.8rem, 4vw, 2.8rem);
                line-height: 1.2;
                margin-bottom: 1rem;
            }

            body.t-salon .about-title em {
                color: var(--p);
                font-style: italic;
            }

            body.t-salon .rule {
                width: 2.5rem;
                height: 1px;
                background: var(--p);
                margin: 1rem 0 1.2rem;
            }

            body.t-salon .about-body {
                color: #8a5a68;
                line-height: 1.88;
                font-size: .95rem;
                font-weight: 300;
            }

            body.t-salon #services-section {
                padding: 7rem 1.5rem;
                background: #f8eef1;
            }

            body.t-salon .section-heading {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(1.8rem, 4vw, 2.8rem);
                color: #2e1420;
                text-align: center;
                margin-bottom: 3rem;
            }

            body.t-salon .service-card {
                background: #fff;
                border: 1px solid rgba(181, 96, 124, .15);
                padding: 2rem 1.5rem;
                text-align: center;
                transition: all .25s;
            }

            body.t-salon .service-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 16px 48px rgba(181, 96, 124, .12);
            }

            body.t-salon .s-icon {
                font-size: 2.2rem;
                margin-bottom: .8rem;
                display: block;
            }

            body.t-salon .s-name {
                font-family: 'DM Serif Display', serif;
                font-size: 1.15rem;
                color: #2e1420;
                margin-bottom: .35rem;
            }

            body.t-salon .s-desc {
                color: #a07080;
                font-size: .82rem;
                line-height: 1.6;
            }

            body.t-salon #cta {
                padding: 7rem 1.5rem;
                background: var(--dk);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            body.t-salon #cta::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(ellipse 70% 60% at 50% 110%, rgba(181, 96, 124, .3) 0%, transparent 65%);
            }

            body.t-salon #cta h2 {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(2rem, 5vw, 3rem);
                color: #fff;
                position: relative;
            }

            body.t-salon #cta p {
                color: rgba(255, 255, 255, .5);
                margin: .8rem 0 2.2rem;
                font-size: .92rem;
                letter-spacing: .05em;
                position: relative;
            }

            body.t-salon #cta button {
                background: transparent;
                color: #fff;
                border: 1px solid rgba(255, 255, 255, .35);
                padding: .9rem 2.5rem;
                font-weight: 600;
                letter-spacing: .15em;
                text-transform: uppercase;
                font-size: .82rem;
                cursor: pointer;
                font-family: 'DM Sans', sans-serif;
                transition: all .25s;
                position: relative;
            }

            body.t-salon #cta button:hover {
                background: var(--p);
                border-color: var(--p);
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(181, 96, 124, .4);
            }

            body.t-salon footer {
                background: #0d0509;
                padding: 2rem;
                text-align: center;
                color: rgba(255, 255, 255, .2);
                font-size: .78rem;
                letter-spacing: .12em;
            }

            /* ══════════════════════════════════
           THEME: DEFAULT
        ══════════════════════════════════ */
            body.t-default {
                --p: #2563eb;
                --a: #06b6d4;
                --dk: #06091a;
                font-family: 'Syne', sans-serif;
                background: #f8faff;
                color: #0f172a;
            }

            body.t-default nav {
                background: rgba(6, 9, 26, .97);
                backdrop-filter: blur(20px);
                padding: 1.1rem 2rem;
                position: sticky;
                top: 0;
                z-index: 200;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid rgba(37, 99, 235, .2);
            }

            body.t-default .nav-brand {
                font-size: 1.2rem;
                font-weight: 800;
                color: #fff;
                letter-spacing: .04em;
            }

            body.t-default .nav-links a {
                color: rgba(255, 255, 255, .45);
                text-decoration: none;
                font-size: .78rem;
                letter-spacing: .1em;
                text-transform: uppercase;
                margin-left: 2rem;
                font-weight: 500;
                transition: color .2s;
            }

            body.t-default .nav-links a:hover {
                color: var(--a);
            }

            body.t-default #hero {
                min-height: 88vh;
                background: var(--dk);
                display: flex;
                align-items: center;
                padding: 4rem 2rem;
                position: relative;
                overflow: hidden;
            }

            body.t-default .hero-grid {
                position: absolute;
                inset: 0;
                background-image: linear-gradient(rgba(37, 99, 235, .07) 1px, transparent 1px), linear-gradient(90deg, rgba(37, 99, 235, .07) 1px, transparent 1px);
                background-size: 56px 56px;
            }

            body.t-default .hero-glow {
                position: absolute;
                width: 560px;
                height: 560px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(37, 99, 235, .22) 0%, transparent 70%);
                top: -80px;
                right: -80px;
                filter: blur(32px);
                pointer-events: none;
            }

            body.t-default .hero-inner {
                max-width: 680px;
                position: relative;
                z-index: 2;
            }

            body.t-default .hero-chip {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                background: rgba(6, 182, 212, .1);
                border: 1px solid rgba(6, 182, 212, .25);
                color: var(--a);
                padding: .35rem 1rem;
                border-radius: 100px;
                font-size: .7rem;
                font-weight: 700;
                letter-spacing: .12em;
                text-transform: uppercase;
                margin-bottom: 1.4rem;
            }

            body.t-default .hero-chip::before {
                content: '●';
                font-size: .45rem;
                animation: blink 1.4s ease infinite;
            }

            @keyframes blink {

                0%,
                100% {
                    opacity: 1
                }

                50% {
                    opacity: .3
                }
            }

            body.t-default #hero h1 {
                font-size: clamp(2.6rem, 7vw, 5.5rem);
                font-weight: 800;
                color: #fff;
                line-height: 1.0;
                letter-spacing: -.02em;
            }

            body.t-default #hero h1 span {
                background: linear-gradient(135deg, var(--p), var(--a));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            body.t-default #hero .tagline {
                color: rgba(255, 255, 255, .45);
                font-size: 1rem;
                margin: 1rem 0 2.2rem;
                font-weight: 400;
            }

            body.t-default .hero-actions {
                display: flex;
                gap: .9rem;
                flex-wrap: wrap;
            }

            body.t-default .btn-primary {
                background: var(--p);
                color: #fff;
                border: none;
                padding: .85rem 2.2rem;
                border-radius: 6px;
                cursor: pointer;
                font-family: 'Syne', sans-serif;
                font-size: .88rem;
                font-weight: 700;
                transition: all .2s;
            }

            body.t-default .btn-primary:hover {
                background: #1d4ed8;
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(37, 99, 235, .45);
            }

            body.t-default .btn-ghost {
                background: transparent;
                color: rgba(255, 255, 255, .6);
                border: 1px solid rgba(255, 255, 255, .14);
                border-radius: 6px;
                padding: .85rem 2.2rem;
                cursor: pointer;
                font-family: 'Syne', sans-serif;
                font-size: .88rem;
                font-weight: 600;
                transition: all .2s;
            }

            body.t-default .btn-ghost:hover {
                border-color: rgba(255, 255, 255, .45);
                color: #fff;
            }

            body.t-default #about {
                padding: 7rem 1.5rem;
                background: #f8faff;
            }

            body.t-default .about-visual {
                aspect-ratio: 1;
                background: linear-gradient(135deg, var(--dk) 0%, #1e40af 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 7rem;
                border-radius: 12px;
                box-shadow: 0 40px 80px rgba(37, 99, 235, .18);
            }

            body.t-default .section-eyebrow {
                font-size: .7rem;
                letter-spacing: .22em;
                text-transform: uppercase;
                color: var(--p);
                margin-bottom: .8rem;
                font-weight: 700;
            }

            body.t-default .about-title {
                font-size: clamp(1.8rem, 4vw, 2.8rem);
                font-weight: 800;
                line-height: 1.1;
                margin-bottom: 1rem;
                letter-spacing: -.02em;
            }

            body.t-default .about-title span {
                color: var(--p);
            }

            body.t-default .rule {
                width: 2.5rem;
                height: 3px;
                background: linear-gradient(to right, var(--p), var(--a));
                border-radius: 4px;
                margin: 1rem 0 1.2rem;
            }

            body.t-default .about-body {
                color: #64748b;
                line-height: 1.85;
                font-size: .95rem;
            }

            body.t-default #services-section {
                padding: 7rem 1.5rem;
                background: var(--dk);
            }

            body.t-default .section-heading {
                font-size: clamp(1.8rem, 4vw, 2.8rem);
                font-weight: 800;
                color: #fff;
                text-align: center;
                margin-bottom: 3rem;
                letter-spacing: -.02em;
            }

            body.t-default .section-heading span {
                color: var(--a);
            }

            body.t-default .service-card {
                background: rgba(255, 255, 255, .03);
                border: 1px solid rgba(255, 255, 255, .06);
                padding: 1.8rem 1.5rem;
                border-radius: 10px;
                transition: all .25s;
                position: relative;
                overflow: hidden;
            }

            body.t-default .service-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 2px;
                background: linear-gradient(to right, var(--p), var(--a));
                transform: scaleX(0);
                transform-origin: left;
                transition: transform .35s;
            }

            body.t-default .service-card:hover::before {
                transform: scaleX(1);
            }

            body.t-default .service-card:hover {
                background: rgba(37, 99, 235, .07);
                transform: translateY(-4px);
                border-color: rgba(37, 99, 235, .28);
            }

            body.t-default .s-icon {
                font-size: 1.8rem;
                margin-bottom: .7rem;
            }

            body.t-default .s-name {
                font-size: 1.05rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: .3rem;
            }

            body.t-default .s-desc {
                color: rgba(255, 255, 255, .35);
                font-size: .82rem;
                line-height: 1.6;
            }

            body.t-default #cta {
                padding: 7rem 1.5rem;
                background: linear-gradient(135deg, var(--p), #7c3aed);
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            body.t-default #cta::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at 25% 50%, rgba(255, 255, 255, .1) 0%, transparent 50%), radial-gradient(circle at 75% 50%, rgba(255, 255, 255, .1) 0%, transparent 50%);
            }

            body.t-default #cta h2 {
                font-size: clamp(2rem, 5vw, 3rem);
                font-weight: 800;
                color: #fff;
                letter-spacing: -.02em;
                position: relative;
            }

            body.t-default #cta p {
                color: rgba(255, 255, 255, .7);
                margin: .8rem 0 2.2rem;
                font-size: .95rem;
                position: relative;
            }

            body.t-default #cta button {
                background: #fff;
                color: var(--p);
                border: none;
                padding: .9rem 2.5rem;
                border-radius: 6px;
                font-weight: 800;
                font-size: .88rem;
                cursor: pointer;
                font-family: 'Syne', sans-serif;
                transition: all .2s;
                position: relative;
            }

            body.t-default #cta button:hover {
                transform: scale(1.04);
                box-shadow: 0 8px 28px rgba(0, 0, 0, .3);
            }

            body.t-default footer {
                background: var(--dk);
                padding: 2rem;
                text-align: center;
                color: rgba(255, 255, 255, .2);
                font-size: .78rem;
                letter-spacing: .1em;
                border-top: 1px solid rgba(37, 99, 235, .15);
            }
        </style>
    </head>

    <body>

        <!-- LOADER -->
        <div id="loader">
            <div class="loader-label">Loading</div>
            <div class="loader-bar">
                <div class="loader-bar-fill"></div>
            </div>
        </div>

        <!-- NAV -->
        <nav>
            <span class="nav-brand" id="navBrand"></span>
            <div class="nav-links" id="navLinks">
                <a href="#hero">Home</a>
                <a href="#about">About</a>
                <a href="#services-section">Services</a>
            </div>
        </nav>

        <!-- HERO -->
        <section id="hero"></section>

        <!-- ABOUT -->
        <section id="about"></section>

        <!-- SERVICES -->
        <section id="services-section"></section>

        <!-- CTA -->
        <section id="cta">
            <h2 id="ctaHeading"></h2>
            <p id="ctaSub"></p>
            <button id="ctaBtn"></button>
        </section>

        <!-- FOOTER -->
        <footer>
            <p id="footerText"></p>
        </footer>

        <script>
            /* ─────────────────────────────────────────────────
           THEME DETECTION  — reads business_type, NOT business_name
        ───────────────────────────────────────────────── */
            function detectTheme(businessType) {
                const t = (businessType || '').toLowerCase();
                const map = {
                    restaurant: ['restaurant', 'cafe', 'cafeteria', 'bistro', 'diner', 'eatery', 'food', 'pizzeria',
                        'bakery', 'catering', 'kitchen', 'grill', 'bbq', 'barbeque', 'burger', 'sushi', 'taco',
                        'fast food', 'cloud kitchen', 'dhaba', 'juice'
                    ],
                    gym: ['gym', 'fitness', 'workout', 'crossfit', 'yoga', 'pilates', 'sport', 'athletic', 'bodybuilding',
                        'health club', 'martial art', 'boxing', 'dance studio', 'personal train', 'wellness', 'zumba',
                        'physio'
                    ],
                    salon: ['salon', 'beauty', 'spa', 'hair', 'nail', 'barber', 'skincare', 'wax', 'lash', 'cosmetic',
                        'makeup', 'groom', 'aesthetic', 'parlour', 'parlor'
                    ],
                };
                for (const [theme, keys] of Object.entries(map)) {
                    if (keys.some(k => t.includes(k))) return theme;
                }
                return 'default';
            }

            /* ─────────────────────────────────────────────────
               THEME CONFIG
            ───────────────────────────────────────────────── */
            const THEMES = {
                restaurant: {
                    aboutEmoji: '👨‍🍳',
                    eyebrow: 'Fine Dining Experience',
                    aboutEyebrow: 'Our Story',
                    aboutTitle: 'A Taste of Perfection',
                    svcHeading: 'Our Menu & Services',
                    ctaHeading: 'Reserve Your Table Tonight',
                    ctaSub: 'Experience unforgettable flavors and warm hospitality',
                    ctaBtn: 'Book a Table',
                    heroBtnLabel: 'View Menu →',
                    svcIcons: ['🥘', '🥡', '🛵', '🎉'],
                    svcDescs: ['Elegant in-house dining experience', 'Freshly packed meals ready to go',
                        'Hot food delivered to your doorstep', 'Custom menus for events & occasions'
                    ],
                    stats: null,
                },
                gym: {
                    aboutEmoji: '🏋️',
                    eyebrow: 'Premium Fitness Center',
                    aboutEyebrow: 'About Us',
                    aboutTitle: 'Built For Champions',
                    svcHeading: 'Our Programs',
                    ctaHeading: 'START YOUR JOURNEY',
                    ctaSub: 'First week free — no excuses',
                    ctaBtn: 'JOIN NOW',
                    heroBtnLabel: 'JOIN NOW',
                    svcIcons: ['🏋️', '🏃', '🥗', '🧘'],
                    svcDescs: ['1-on-1 sessions with certified coaches', 'High-intensity programs for real results',
                        'Balanced nutrition plans for performance', 'Mind & body recovery and wellness'
                    ],
                    stats: [{
                        n: '500+',
                        l: 'Members'
                    }, {
                        n: '50+',
                        l: 'Classes / wk'
                    }, {
                        n: '15+',
                        l: 'Trainers'
                    }],
                },
                salon: {
                    aboutEmoji: '💅',
                    eyebrow: 'Premium Beauty Studio',
                    aboutEyebrow: 'Our Story',
                    aboutTitle: 'Beauty Is Our <em>Art</em>',
                    svcHeading: 'Our Services',
                    ctaHeading: 'Book Your Experience',
                    ctaSub: 'Complimentary consultation with every visit',
                    ctaBtn: 'Book Now',
                    heroBtnLabel: 'Book Now',
                    svcIcons: ['💇', '✨', '💄', '🌿'],
                    svcDescs: ['Expert cuts & colour for your style', 'Rejuvenating facials for glowing skin',
                        'Professional looks for every occasion', 'Premium skincare and treatment solutions'
                    ],
                    stats: null,
                },
                default: {
                    aboutEmoji: '💡',
                    eyebrow: 'Now Live',
                    aboutEyebrow: 'About Us',
                    aboutTitle: 'Built to <span>Scale</span>',
                    svcHeading: 'What We <span>Offer</span>',
                    ctaHeading: 'Ready to Get Started?',
                    ctaSub: "Let's build something great together",
                    ctaBtn: 'Get in Touch',
                    heroBtnLabel: 'Get Started →',
                    svcIcons: ['⚡', '🔧', '🎯', '📈'],
                    svcDescs: ['End-to-end strategy and consulting', 'Tailored solutions for your workflow',
                        'Round-the-clock support and guidance', 'Data-driven growth and performance'
                    ],
                    stats: null,
                }
            };

            /* ─────────────────────────────────────────────────
               RENDERERS
            ───────────────────────────────────────────────── */
            function renderHero(w, th, tk) {
                const title = w.title || 'Welcome to ' + w.business_name;
                const tagline = w.tagline || '';

                if (tk === 'restaurant') return `
        <div class="hero-tag u-fade-in">${th.eyebrow}</div>
        <h1 class="u-fade-up d1">${title}</h1>
        <p class="tagline u-fade-up d2">${tagline}</p>
        <button class="btn-primary u-fade-up d3">${th.heroBtnLabel}</button>`;

                if (tk === 'gym') {
                    const stats = (th.stats || []).map(s =>
                        `<div><div class="stat-n">${s.n}</div><div class="stat-l">${s.l}</div></div>`).join('');
                    return `
            <div class="hero-stripe"></div>
            <div class="hero-big-text" aria-hidden="true">${w.business_name.charAt(0).toUpperCase()}</div>
            <div class="hero-inner">
                <span class="hero-tag u-fade-in">${th.eyebrow}</span>
                <h1 class="u-fade-up d1">${title.toUpperCase()}</h1>
                <p class="tagline u-fade-up d2">${tagline}</p>
                <button class="btn-primary u-fade-up d3">${th.heroBtnLabel}</button>
                ${stats ? `<div class="hero-stats u-fade-up d4">${stats}</div>` : ''}
            </div>`;
                }

                if (tk === 'salon') return `
        <div class="hero-left">
            <span class="hero-tag u-fade-in">${th.eyebrow}</span>
            <h1 class="u-fade-up d1">${title}</h1>
            <p class="tagline u-fade-up d2">${tagline}</p>
            <button class="btn-primary u-fade-up d3">${th.heroBtnLabel}</button>
        </div>
        <div class="hero-right u-scale-up d2">✂️</div>`;

                // default
                const hi = title.replace(w.business_name, `<span>${w.business_name}</span>`);
                return `
        <div class="hero-grid" aria-hidden="true"></div>
        <div class="hero-glow" aria-hidden="true"></div>
        <div class="hero-inner">
            <div class="hero-chip u-fade-in">${th.eyebrow}</div>
            <h1 class="u-fade-up d1">${hi}</h1>
            <p class="tagline u-fade-up d2">${tagline}</p>
            <div class="hero-actions u-fade-up d3">
                <button class="btn-primary">${th.heroBtnLabel}</button>
                <button class="btn-ghost">Learn More</button>
            </div>
        </div>`;
            }

            function renderAbout(w, th, tk) {
                const badge = tk === 'gym' ?
                    `<div class="about-badge">10+<span>YRS EXP</span></div>` : '';
                return `
        <div class="container">
            <div class="grid-2-fixed">
                <div class="about-visual u-scale-up hide-mobile">${th.aboutEmoji}${badge}</div>
                <div class="u-fade-up d2">
                    <p class="section-eyebrow">${th.aboutEyebrow}</p>
                    <h2 class="about-title">${th.aboutTitle}</h2>
                    <div class="rule"></div>
                    <p class="about-body">${w.about}</p>
                </div>
            </div>
        </div>`;
            }

            function renderServices(w, th, tk) {
                const cards = (w.services || []).map((s, i) => `
        <div class="service-card u-fade-up d${i+1}">
            <div class="s-icon">${th.svcIcons[i]||'✦'}</div>
            <div class="s-name">${s}</div>
            <div class="s-desc">${th.svcDescs[i]||''}</div>
        </div>`).join('');
                return `
        <div class="container">
            <p class="section-eyebrow u-fade-in" style="text-align:center;display:block;opacity:.5;margin-bottom:.4rem;">What We Offer</p>
            <h2 class="section-heading u-fade-up">${th.svcHeading}</h2>
            <div class="grid-2">${cards}</div>
        </div>`;
            }

            /* ─────────────────────────────────────────────────
               FETCH + RENDER
               NOTE:
                 res.data.business_name  → displayed as the brand name
                 res.data.business_type  → used ONLY for theme detection
            ───────────────────────────────────────────────── */
            fetch('/api/websites/{{ $id }}', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                        'Accept': 'application/json'
                    }
                })
                .then(r => {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                })
                .then(res => {
                    const w = res.data; // ← res.data (not res directly)
                    const tk = detectTheme(w.business_type); // ← uses business_type for theme
                    const th = THEMES[tk];

                    document.body.classList.add('t-' + tk);

                    // Nav brand  ← shows business_name
                    const brand = document.getElementById('navBrand');
                    if (tk === 'gym') {
                        brand.innerHTML = `<span>${w.business_name.charAt(0)}</span>${w.business_name.slice(1)}`;
                    } else {
                        brand.textContent = w.business_name;
                    }

                    // Render sections
                    document.getElementById('hero').innerHTML = renderHero(w, th, tk);
                    document.getElementById('about').innerHTML = renderAbout(w, th, tk);
                    document.getElementById('services-section').innerHTML = renderServices(w, th, tk);

                    // CTA
                    document.getElementById('ctaHeading').textContent = th.ctaHeading;
                    document.getElementById('ctaSub').textContent = th.ctaSub;
                    document.getElementById('ctaBtn').textContent = th.ctaBtn;

                    // Footer
                    document.getElementById('footerText').textContent =
                        '© ' + new Date().getFullYear() + ' ' + w.business_name + '. All rights reserved.';

                    // Dismiss loader
                    setTimeout(() => document.getElementById('loader').classList.add('hidden'), 450);
                })
                .catch(err => {
                    console.error('API Error:', err);
                    document.body.classList.add('t-default');
                    document.getElementById('loader').classList.add('hidden');
                });
        </script>

    </body>

</html>
