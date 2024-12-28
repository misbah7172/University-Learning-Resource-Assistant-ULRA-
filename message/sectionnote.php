<?php
// Database connection
$servername = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "ulra"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle note upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $text = $_POST['text'];
    $section = $_POST['section'];
    $files = $_FILES['files'];

    // Insert note into the database
    $stmt = $conn->prepare("INSERT INTO Notes (text, section) VALUES (?, ?)");
    $stmt->bind_param("ss", $text, $section);
    $stmt->execute();
    $noteId = $stmt->insert_id;

    // Handle file uploads
    foreach ($files['tmp_name'] as $key => $tmpName) {
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = basename($files['name'][$key]);
            $targetPath = "uploads/" . $fileName; // Ensure this directory exists and is writable
            move_uploaded_file($tmpName, $targetPath);

            // Save file info to the database
            $stmtFile = $conn->prepare("INSERT INTO Files (note_id, file_name, file_path) VALUES (?, ?, ?)");
            $stmtFile->bind_param("iss", $noteId, $fileName, $targetPath);
            $stmtFile->execute();
        }
    }

    $stmt->close();
}

// Handle note deletion
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $noteId = $_DELETE['id'];

    $stmt = $conn->prepare("DELETE FROM Notes WHERE id = ?");
    $stmt->bind_param("i", $noteId);
    $stmt->execute();
    $stmt->close();
}

// Fetch notes by section
$notes = [];
if (isset($_GET['section'])) {
    $section = $_GET['section'];
    $stmt = $conn->prepare("SELECT * FROM Notes WHERE section = ?");
    $stmt->bind_param("s", $section);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section-wise Notes</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; }
        .note { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
        textarea { width: 100%; height: 100px; }
        input[type="file"] { margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Section-wise Notes</h1>
        <div class="section-selection">
            <label for="sectionSelect">Select Course:</label>
            <select id="sectionSelect" onchange="loadNotes()">
                <option value="">--Select Course--</option>
                <option value="Class A">Course 1</option>
                <option value="Class B">Course 2</option>
            </select>
            <label for="sectionSelect">Select Section:</label>
            <select id="sectionSelect" onchange="loadNotes()">
                <option value="">--Select Section--</option>
                <option value="Class A">Class A</option>
                <option value="Class B">Class B</option>
            </select>
        </div>
        <div class="note-upload">
            <textarea id="noteText" placeholder="Write your notes here..."></textarea>
            <input type="file" id="fileInput" multiple accept=".png, .jpg, .jpeg, .pdf, .docx">
            <button id="uploadButton">Upload Notes</button>
        </div>
        <div id="notesDisplay">
            <?php foreach ($notes as $note): ?>
                <div class="note" id="note-<?php echo $note['id']; ?>">
                    <p><?php echo $note['text']; ?></p>
                    <?php
                    // Fetch and display associated files
                    $stmtFiles = $conn->prepare("SELECT * FROM Files WHERE note_id = ?");
                    $stmtFiles->bind_param("i", $note['id']);
                    $stmtFiles->execute();
                    $resultFiles = $stmtFiles->get_result();
                    while ($file = $resultFiles->fetch_assoc()) {
                        echo '<a href="' . $file['file_path'] . '" target="_blank">' . $file['file_name'] . '</a><br>';
                    }
                    $stmtFiles->close();
                    ?>
                    <button onclick="deleteNote(<?php echo $note['id']; ?>)">Delete</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        function loadNotes() {
            const section = document.getElementById('sectionSelect').value;
            window.location.href = `index.php?section=${section}`;
        }

        document.getElementById('uploadButton').addEventListener('click', function() {
            const noteText = document.getElementById('noteText').value;
            const files = document.getElementById('fileInput').files;
            const section = document.getElementById('sectionSelect').value;

            if (!section) {
                alert('Please select a section.');
                return;
            }

            const formData = new FormData();
            formData.append('text', noteText);
            formData.append('section', section);
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            fetch('index.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Notes uploaded successfully!');
                loadNotes(); // Refresh notes display
            })
            .catch(error => console.error('Error uploading notes:', error));
        });

        function deleteNote(noteId) {
            fetch('index.php', {
                method: 'DELETE',
                body: new URLSearchParams({ id: noteId })
            })
            .then(response => response.text())
            .then(data => {
                alert('Note deleted successfully!');
                document.getElementById('note-' + noteId).remove(); // Remove note from display
            })
            .catch(error => console.error('Error deleting note:', error));
        }
    </script>
</body>
</html>