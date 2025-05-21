// Get user's contact messages
$sql_messages = "SELECT * FROM contact_messages WHERE user_id = ? ORDER BY created_at DESC";
$stmt_messages = $conn->prepare($sql_messages);
$stmt_messages->bind_param("i", $_SESSION['user']['id']);
$stmt_messages->execute();
$result_messages = $stmt_messages->get_result();

echo '<section class="messages">';
echo '<div class="container">';
echo '<h2 class="heading">Мои сообщения</h2>';
echo '<div class="messages__list">';

if ($result_messages->num_rows > 0) {
    while($row = $result_messages->fetch_assoc()) {
        echo '<div class="message-item">';
        echo '<div class="message-item__header">';
        echo '<p class="message-item__date">' . date('d.m.Y H:i', strtotime($row['created_at'])) . '</p>';
        echo '</div>';
        echo '<div class="message-item__content">';
        echo '<p class="message-item__text">' . htmlspecialchars($row['message']) . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p class="no-messages">У вас пока нет отправленных сообщений</p>';
}

echo '</div>';
echo '</div>';
echo '</section>';

$stmt_messages->close(); 