<form method="POST" class="solver-form">
  <textarea name="input" placeholder="Enter problem input"
    required><?= htmlspecialchars($_POST['input'] ?? '') ?></textarea>
  <input type="hidden" name="problem" value="<?= $problem ?>">
  <input type="hidden" name="part" value="<?= $part ?>">
  <button type="submit">Solve</button>
</form>