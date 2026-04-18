<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Website Preview</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-50 text-gray-800">

        <!-- HERO -->
        <section id="hero" class="text-center py-20 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
            <h1 id="title" class="text-4xl font-bold mb-3"></h1>
            <p id="tagline" class="text-lg opacity-90"></p>
        </section>

        <!-- ABOUT -->
        <section class="max-w-5xl mx-auto py-16 px-6">
            <h2 class="text-2xl font-semibold mb-4">About Us</h2>
            <p id="about" class="text-gray-700 leading-relaxed"></p>
        </section>

        <!-- SERVICES -->
        <section class="bg-white py-16">
            <div class="max-w-5xl mx-auto px-6">
                <h2 class="text-2xl font-semibold mb-6 text-center">Our Services</h2>

                <div id="services" class="grid md:grid-cols-2 gap-6"></div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="text-center py-6 bg-gray-900 text-white mt-10">
            <p id="footer"></p>
        </footer>

        <script>
            fetch('/api/websites/{{ $id }}', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {

                    let w = data.data;

                    // HERO
                    document.getElementById('title').innerText = w.title;
                    document.getElementById('tagline').innerText = w.tagline;

                    // ABOUT
                    document.getElementById('about').innerText = w.about;

                    // SERVICES
                    let servicesHtml = '';
                    w.services.forEach(s => {
                        servicesHtml += `
            <div class="p-5 border rounded-lg shadow-sm hover:shadow-md transition">
                <h3 class="font-semibold text-lg">${s}</h3>
            </div>
        `;
                    });

                    document.getElementById('services').innerHTML = servicesHtml;

                    // FOOTER
                    document.getElementById('footer').innerText =
                        "© " + new Date().getFullYear() + " " + w.business_name + ". All rights reserved.";
                });
        </script>

    </body>

</html>
