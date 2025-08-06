<?php
include("../Include/init.php");

$storyId = $_GET['id'] ?? null;
if (!$storyId) {
    exit("Story ID missing.");
}

$story = getStory($storyId);
$chapters = getAllChapters($storyId);
$choicesByChapter = getChoicesByChapter($storyId); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateStory($storyId, $_POST['title'], $_POST['description']);

    foreach ($_POST['chapters'] as $chapterId => $chapterData) {
        $desc = $chapterData['description'];
        $isStart = isset($chapterData['isStart']) ? 1 : 0;
        $isEnd = isset($chapterData['isEnd']) ? 1 : 0;
        updateChapter($chapterId, $desc, $isStart, $isEnd);
    }

    foreach ($_POST['choices'] as $choiceId => $choiceData) {
        $text = $choiceData['choiceText'];
        $nextId = $choiceData['toChapterId'];
        updateChoice($choiceId, $text, $nextId);
    }

    echo "<p style='color: green;'> All updates saved!</p>";
}

echoHeader("Edit stories"); 

echo "<form method='POST' class='form-box'>
        <input type='hidden' name='action' value='update_story'>
        <h1>Edit Story</h1>
        <label>Title:</label><br>
        <input type='text' name='title' value='" . htmlspecialchars($story['title']) . "' required><br>
        <label>Description:</label><br>
        <textarea  name='description' rows='4'>" . htmlspecialchars($story['description']) . "</textarea><br>
        <h2>Chapters</h2>"; 

foreach ($chapters as $chapter) {
    $chapterId = $chapter['chapterId'];
    $classes = "chapter-box";
    if ($chapter['isStart']) $classes .= " start-chapter";
    if ($chapter['isEnd']) $classes .= " end-chapter";

    echo "<div class='$classes'>
        <h3>Chapter $chapterId</h3>
        <label>Title:</label><br>
        <textarea name='chapters[$chapterId][title]' rows='4'>" . htmlspecialchars($chapter['title']) . "</textarea><br>
        <label>Description:</label><br>
        <textarea name='chapters[$chapterId][description]' rows='4'>" . htmlspecialchars($chapter['description']) . "</textarea><br>
        <label><input type='checkbox' name='chapters[$chapterId][isStart]' value='1' " . ($chapter['isStart'] ? "checked" : "") . "> Is Start?</label><br>
        <label><input type='checkbox' name='chapters[$chapterId][isEnd]' value='1' " . ($chapter['isEnd'] ? "checked" : "") . "> Is End?</label><br>
        
        <h3>Choices</h3>";
    if (isset($choicesByChapter[$chapterId])) {
        foreach ($choicesByChapter[$chapterId] as $index => $choice) {
            $choiceId = $choice['choiceId'];
            echo "<label>Choice " . ($index + 1) . " Text:</label>
            <input type='text' name='choices[$choiceId][choiceText]' value='" . htmlspecialchars($choice['choiceText']) . "'><br>
            <label>Leads to Chapter:</label>
            <select name='choices[$choiceId][toChapterId]'>";
            foreach ($chapters as $target) {
                $selected = ($target['chapterId'] == $choice['toChapterId']) ? "selected" : "";
                echo "<option value='{$target['chapterId']}' $selected>Chapter {$target['chapterId']}</option>";
            }
            echo "</select><br><br>";
        }
    } else {
        echo "<p><em>No choices found for this chapter.</em></p>";
    }

    echo "</div>
    </div>";
}

echo "<input type='submit' value='Save All Changes'>
</form>";

echoFooter(); 