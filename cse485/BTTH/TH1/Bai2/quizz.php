<?php
session_start();

// Đọc Quiz.txt
$text = @file_get_contents("Quiz.txt");
if ($text === false) { echo "Không tìm thấy Quiz.txt"; exit; }
$lines = preg_split("/\r\n|\n|\r/", $text);

$quiz = [];
$i = 0;
$n = count($lines);

while ($i < $n) {
    while ($i < $n && trim($lines[$i]) === "") $i++;
    if ($i >= $n) break;

    $question = trim($lines[$i]); 
    $i++;

    $options = [];
    while ($i < $n && stripos($lines[$i], "ANSWER:") === false) {
        $line = trim($lines[$i]);
        if ($line !== "") $options[] = $line;
        $i++;
    }

    $answers = [];
    if ($i < $n && stripos($lines[$i], "ANSWER:") !== false) {
        $ans = trim(substr($lines[$i], 7));
        $parts = preg_split('/[,\;\s]+/', $ans);
        foreach ($parts as $p) {
            $p = preg_replace('/\./','', trim($p));
            if ($p !== "") $answers[] = strtoupper($p[0]);
        }
        $i++;
    }

    $quiz[] = [
        "question" => $question,
        "options"  => $options,
        "answers"  => array_values(array_unique($answers))
    ];
}

// Nếu POST → lưu vào session rồi redirect (PRG)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = [];

    foreach ($quiz as $idx => $q) {
        $picked = [];
        if (isset($_POST["q{$idx}"])) {
            $raw = $_POST["q{$idx}"];
            if (!is_array($raw)) $raw = [$raw];
            foreach ($raw as $v) $picked[] = strtoupper(trim($v));
        }
        $picked = array_values(array_unique(array_filter($picked)));
        sort($picked);
        $result[$idx] = $picked;
    }

    $_SESSION['result'] = $result;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Lấy kết quả từ session (nếu có)
$result = [];
if (isset($_SESSION['result'])) {
    $result = $_SESSION['result'];
    unset($_SESSION['result']);
}
?>
<style>
.correct { color: green; font-weight: bold; }
.wrong   { color: red; font-weight: bold; }
.icon    { font-size: 20px; font-weight: bold; margin-left: 10px; }
</style>

<h2>Bài thi trắc nghiệm</h2>

<form method="post">
<?php foreach ($quiz as $idx => $q): 
    $isMulti = count($q["answers"]) > 1;

    // Tính đúng/sai cho từng câu
    $statusIcon = ""; 
    if ($result) {
        $correct = $q['answers'];
        sort($correct);

        $picked = $result[$idx] ?? [];
        sort($picked);

        if ($picked === $correct) {
            $statusIcon = "<span class='icon correct'>✓</span>";
        } else {
            $statusIcon = "<span class='icon wrong'>✗</span>";
        }
    }
?>

<?php
// Icon màu xanh/đỏ đơn giản
$icon = "";
if ($result) {
    $correct = $q['answers']; sort($correct);
    $picked  = $result[$idx] ?? []; sort($picked);

    if ($picked === $correct) {
        $icon = "<span style='color: green;'>✓</span>";
    } else {
        $icon = "<span style='color: red;'>✗</span>";
    }
}
?>

<p>
    <?= $icon ?>
    <strong>Câu <?= $idx+1 ?>:</strong>
    <?= htmlspecialchars($q["question"]) ?>
</p>

    <?php foreach ($q["options"] as $opt):

        // Tách A, B, C...
        if (preg_match('/^([A-Z])\s*[.)]\s*(.*)$/i', $opt, $m)) {
            $key = strtoupper($m[1]);
            $text = $m[2];
        } else {
            $key = strtoupper(substr($opt,0,1));
            $text = $opt;
        }

        $name = $isMulti ? "q{$idx}[]" : "q{$idx}";
        $class = "";

        if ($result) {
            $picked = $result[$idx] ?? [];
            if (in_array($key, $q['answers'])) {
                $class = "correct"; 
            }
            if (in_array($key, $picked) && !in_array($key, $q['answers'])) {
                $class = "wrong";   
            }
        }
    ?>

    <label class="<?= $class ?>">
        <input type="<?= $isMulti ? 'checkbox':'radio' ?>"
               name="<?= $name ?>"
               value="<?= $key ?>">
        <?= htmlspecialchars($key . ". " . $text) ?>
    </label><br>

    <?php endforeach; ?>
    <br>

<?php endforeach; ?>

    <button type="submit">Nộp bài</button>
</form>

<?php
// Tính tổng điểm
if ($result) {
    $score = 0;
    foreach ($quiz as $idx => $q) {
        $correct = $q['answers']; sort($correct);
        $picked = $result[$idx] ?? []; sort($picked);
        if ($picked === $correct) $score++;
    }
    echo "<h3>Kết quả: $score / " . count($quiz) . " câu đúng</h3>";
}
?>
