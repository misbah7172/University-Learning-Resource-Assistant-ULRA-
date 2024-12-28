<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Learning Resource Assistant</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background-image: image('images/uiu.jpg');
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/api/placeholder/1920/1080') center/cover;
            min-height: 600px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .testimonial-section {
            background: linear-gradient(135deg, #f6f9fc 0%, #edf2f7 100%);
        }

        .social-icon:hover {
            color: #3B82F6;
            transform: scale(1.1);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <header class="fixed w-full bg-white shadow-md z-50">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="student/ULRA.png" alt="Logo" class="h-8">
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600">Home</a>
                    <a href="#features" class="text-gray-700 hover:text-blue-600">Features</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600">Contact Us</a>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700"><a href="student/login/index.php">Login</a></button>
                </div>
                <button class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero-section flex items-center justify-center text-white" style="background-image: url('images/1.jpg'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Your Personalized Assistant for University Learning!</h1>
            <p class="text-xl md:text-2xl mb-8">Simplify your academic life with messaging, assignment tracking, reminders, and more.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-16">Our Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Cards -->
                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Section-Wise Message Box</h3>
                    <p class="text-gray-600">Collaborate with your classmates easily through organized discussion boards.</p>
                </div>

                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Person-to-Person Messaging</h3>
                    <p class="text-gray-600">Stay connected with your peers and professors through direct messaging.</p>
                </div>

                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-circle-check"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Active Status</h3>
                    <p class="text-gray-600">Know who's online and ready to help with real-time status updates.</p>
                </div>

                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Assignment Tracker</h3>
                    <p class="text-gray-600">Never miss a deadline with personalized reminders and task management.</p>
                </div>

                <div class="feature-card bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-note-sticky"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Personal and Section Notes</h3>
                    <p class="text-gray-600">Organize your ideas and access shared resources efficiently.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="bg-blue-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Transform Your Learning Experience</h2>
            <p class="text-xl mb-8">Effortless organization, improved communication, and timely reminders.</p>
            <button class="bg-white text-blue-600 px-8 py-3 rounded-full text-lg hover:bg-blue-50 transform hover:scale-105 transition duration-300">
                Learn More
            </button>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonial-section py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-16">What Students Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-2xl mb-4">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"This platform has completely transformed how I manage my coursework. The assignment tracker is a lifesaver!"</p>
                    <p class="font-semibold">- Sarah Johnson, Computer Science</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-2xl mb-4">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"The messaging features make group projects so much easier to coordinate. Highly recommend!"</p>
                    <p class="font-semibold">- Michael Chen, Business</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 text-2xl mb-4">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"Being able to organize notes by section has helped me stay on top of all my classes."</p>
                    <p class="font-semibold">- Emma Davis, Engineering</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-blue-400">About Us</a></li>
                        <li><a href="#" class="hover:text-blue-400">Features</a></li>
                        <li><a href="#" class="hover:text-blue-400">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-blue-400">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-blue-400">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook text-2xl"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter text-2xl"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram text-2xl"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin text-2xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>© 2024 University Learning Resource Assistant. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            const mobileMenu = document.createElement('div');
            mobileMenu.className = 'fixed inset-0 bg-white z-50 flex flex-col items-center justify-center space-y-6';
            mobileMenu.innerHTML = `
                <button class="absolute top-4 right-4 text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
                <a href="#" class="text-gray-700 text-xl">Home</a>
                <a href="#features" class="text-gray-700 text-xl">Features</a>
                <a href="#" class="text-gray-700 text-xl">Contact Us</a>
                <button class="bg-blue-600 text-white px-6 py-2 rounded-full">Login</button>
                <button class="bg-blue-100 text-blue-600 px-6 py-2 rounded-full">Register</button>
            `;
            
            document.body.appendChild(mobileMenu);
            document.body.style.overflow = 'hidden';
            
            mobileMenu.querySelector('button').addEventListener('click', function() {
                mobileMenu.remove();
                document.body.style.overflow = 'auto';
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>