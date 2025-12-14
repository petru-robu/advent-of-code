<?php
$problem = (int)($_GET['problem'] ?? 1);
$part = (int)($_GET['part'] ?? 1);

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  // Always trim input
  $input = trim($_POST['input'] ?? '');

  // Path to solver
  $solverPath = __DIR__ . "/$problem/$part.php";

  if (file_exists($solverPath))
  {
    // Include solver, which uses $input and must set $result
    require $solverPath;
  }
  else
  {
    $result = 'Solver not found.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Problem <?= $problem ?> - Part <?= $part ?></title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <h1>Problem <?= $problem ?> - Part <?= $part ?></h1>

    <?php include __DIR__ . '/solver_form.php'; ?>

    <?php if ($result !== null): ?>
      <div class="result">
        <h2>Result</h2>
        <pre><?= htmlspecialchars($result) ?></pre>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>