<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Learning Resources</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --background-color: #f5f6fa;
            --text-color: #2c3e50;
            --border-color: #dcdde1;
            --shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            background: white;
            padding: 20px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .search-section {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-section select,
        .search-section input {
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            flex: 1;
            min-width: 200px;
        }

        /* Navigation Styles */
        .nav-bar {
            background: white;
            padding: 10px;
            margin: 20px 0;
            border-radius: 4px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 80px;
            z-index: 900;
        }

        .nav-links {
            display: flex;
            justify-content: space-around;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .nav-links a.active {
            background-color: var(--secondary-color);
            color: white;
        }

        /* Section Styles */
        .section {
            background: white;
            margin: 20px 0;
            padding: 20px;
            border-radius: 4px;
            box-shadow: var(--shadow);
        }

        .section-title {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
        }

        /* Books Section */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .book-card {
            background: white;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
        }

        .book-card button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        /* Videos Section */
        .videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .video-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            overflow: hidden;
        }

        .video-placeholder {
            background: #ddd;
            width: 100%;
            padding-top: 56.25%;
            position: relative;
        }

        .video-info {
            padding: 15px;
        }

        /* Exam Section */
        .exam-filters {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .exam-filters select {
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        .exam-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            border: none;
            background: none;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab-button.active {
            border-bottom-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .exam-card {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .nav-links {
                flex-direction: column;
                text-align: center;
            }

            .nav-links a {
                display: block;
                margin: 5px 0;
            }

            .books-grid,
            .videos-grid {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="search-section">
                <select id="courseSelect">
                    <option value="">Select a Course</option>
                    <option value="cs101">CS101 - Introduction to Programming</option>
                    <option value="cs201">CS201 - Data Structures</option>
                    <option value="math101">MATH101 - Calculus I</option>
                </select>
                <input type="text" id="searchInput" placeholder="Search resources...">
            </div>
        </div>
    </div>

    <div class="container">
        <nav class="nav-bar">
            <ul class="nav-links">
                <li><a href="#books" class="active">Books</a></li>
                <li><a href="#videos">Videos</a></li>
            </ul>
        </nav>

        <section id="books" class="section">
            <h2 class="section-title">Books</h2>
            <div class="books-grid" id="booksContent">
                <!-- Books will be dynamically populated -->
            </div>
        </section>

        <section id="videos" class="section">
            <h2 class="section-title">Videos</h2>
            <div class="videos-grid" id="videosContent">
                <!-- Videos will be dynamically populated -->
            </div>
        </section>

        <section id="exams" class="section">
            <h2 class="section-title">Exam Questions & Solutions</h2>
            <div class="exam-filters">
                <select id="examYear">
                    <option value="">Select Year</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                </select>
                <select id="examSemester">
                    <option value="">Select Semester</option>
                    <option value="fall">Fall</option>
                    <option value="spring">Spring</option>
                    <option value="summer">Summer</option>
                </select>
            </div>
            <div class="exam-tabs">
                <button class="tab-button active" data-tab="midterm">Midterm</button>
                <button class="tab-button" data-tab="final">Final</button>
            </div>
            <div id="examsContent">
                <!-- Exams will be dynamically populated -->
            </div>
        </section>
    </div>

    <script>
        // Sample data structure
        const courseData = {
            cs101: {
                books: [
                    { title: "Introduction to Programming", author: "John Smith", url: "#" },
                    { title: "Python Basics", author: "Jane Doe", url: "#" },
                    { title: "Coding Fundamentals", author: "Mike Johnson", url: "#" }
                ],
                videos: [
                    { title: "Programming Basics", description: "Learn the fundamentals of programming", url: "#" },
                    { title: "Variables & Data Types", description: "Understanding variables in programming", url: "#" },
                    { title: "Control Structures", description: "Learn about loops and conditions", url: "#" }
                ],
                exams: {
                    midterm: [
                        { year: "2024", semester: "spring", title: "Midterm Exam 2024", url: "#" },
                        { year: "2023", semester: "fall", title: "Midterm Exam 2023", url: "#" }
                    ],
                    final: [
                        { year: "2024", semester: "spring", title: "Final Exam 2024", url: "#" },
                        { year: "2023", semester: "fall", title: "Final Exam 2023", url: "#" }
                    ]
                }
            }
            // Add more courses as needed
        };

        // DOM Elements
        const courseSelect = document.getElementById('courseSelect');
        const searchInput = document.getElementById('searchInput');
        const booksContent = document.getElementById('booksContent');
        const videosContent = document.getElementById('videosContent');
        const examsContent = document.getElementById('examsContent');
        const examYear = document.getElementById('examYear');
        const examSemester = document.getElementById('examSemester');
        const tabButtons = document.querySelectorAll('.tab-button');
        const navLinks = document.querySelectorAll('.nav-links a');

        // Current state
        let currentCourse = '';
        let currentExamType = 'midterm';
        let searchTerm = '';

        // Event Listeners
        courseSelect.addEventListener('change', updateContent);
        searchInput.addEventListener('input', handleSearch);
        examYear.addEventListener('change', filterExams);
        examSemester.addEventListener('change', filterExams);

        tabButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                e.target.classList.add('active');
                currentExamType = e.target.dataset.tab;
                updateExams();
            });
        });

        // Intersection Observer for section highlighting
        const sections = document.querySelectorAll('.section');
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    updateActiveNavLink(id);
                }
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));

        // Functions
        function updateContent() {
            currentCourse = courseSelect.value;
            if (currentCourse && courseData[currentCourse]) {
                updateBooks();
                updateVideos();
                updateExams();
            }
        }

        function handleSearch() {
            searchTerm = searchInput.value.toLowerCase();
            updateBooks();
            updateVideos();
            updateExams();
        }

        function updateBooks() {
            if (!currentCourse || !courseData[currentCourse]) return;

            const books = courseData[currentCourse].books.filter(book => 
                book.title.toLowerCase().includes(searchTerm) ||
                book.author.toLowerCase().includes(searchTerm)
            );

            booksContent.innerHTML = books.map(book => `
                <div class="book-card">
                    <h3>${book.title}</h3>
                    <p>Author: ${book.author}</p>
                    <button onclick="window.location.href='${book.url}'">
                        <i class="fas fa-download"></i> Download/View
                    </button>
                </div>
            `).join('');
        }

        function updateVideos() {
            if (!currentCourse || !courseData[currentCourse]) return;

            const videos = courseData[currentCourse].videos.filter(video =>
                video.title.toLowerCase().includes(searchTerm) ||
                video.description.toLowerCase().includes(searchTerm)
            );

            videosContent.innerHTML = videos.map(video => `
                <div class="video-card">
                    <div class="video-placeholder"></div>
                    <div class="video-info">
                        <h3>${video.title}</h3>
                        <p>${video.description}</p>
                    </div>
                </div>
            `).join('');
        }

        function updateExams() {
            if (!currentCourse || !courseData[currentCourse]) return;

            let exams = courseData[currentCourse].exams[currentExamType];
            const selectedYear = examYear.value;
            const selectedSemester = examSemester.value;

            if (selectedYear) {
                exams = exams.filter(exam => exam.year === selectedYear);
            }
            if (selectedSemester) {
                exams = exams.filter(exam => exam.semester === selectedSemester);
            }

            exams = exams.filter(exam => 
                exam.title.toLowerCase().includes(searchTerm)
            );

            examsContent.innerHTML = exams.map(exam => `
                <div class="exam-card">
                    <h3>${exam.title}</h3>
                    <p>Semester: ${exam.semester} ${exam.year}</p>
                    <button onclick="window.location.href='${exam.url}'">
                        <i class="fas fa-download"></i> Download/View
                    </button>
                </div>
            `).join('');
        }

        function filterExams() {
            updateExams();
        }

        function updateActiveNavLink(sectionId) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${sectionId}`) {
                    link.classList.add('active');
                }
            });
        }

        // Smooth scrolling for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
            });
    </script>