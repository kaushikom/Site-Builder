<?php

// Fetches all columns from db
if (isset($_SESSION["user_id"])) {
    $query = 'SELECT * FROM section WHERE user_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $collection = [];

    while ($row = $result->fetch_assoc()) {
        $collection[] = [
            'id' => $row['id'],
            'sectiondata' => json_decode($row['sectiondata'], true)
        ];
    }
}

$genericSections = [];
foreach ($collection as $item) {
    foreach ($item['sectiondata'] as $innerArray) {
        $innerArray['id'] = $item['id'];
        $genericSections[] = $innerArray;
    }
}

// Handle Delete

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['section_id']) && isset($_SESSION['user_id'])) {
    $section_id = intval($_POST['section_id']);
    $user_id = $_SESSION['user_id'];

    $query = "DELETE FROM section WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $section_id, $user_id);
    $stmt->execute();
}
?>
<?php if ($genericSections): ?>
    <div class="container w-75 mx-auto mt-4 border rounded p-2" style="min-width:350px; max-width: 1000px;">
        <h3 class="text-center">Manage Sections</h3>
        <?php foreach ($genericSections as $obj): ?>
            <div class="d-flex justify-content-between align-items-center mb-4 shadow-sm p-3 bg-body-tertiary rounded">
                <span><?php echo htmlspecialchars($obj['heading']); ?></span>
                <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this section?');">
                    <input type="hidden" name="section_id" value="<?php echo $obj['id']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif ?>