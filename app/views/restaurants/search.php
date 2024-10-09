<!-- app/views/restaurants/search.php -->
<h2>Restoran Ara</h2>

<form action="index.php?page=restaurants&action=search" method="GET">
    <label for="name">Restoran Adı:</label>
    <input type="text" id="name" name="name"><br>

    <label for="location">Konum:</label>
    <input type="text" id="location" name="location"><br>

    <label for="cuisine">Mutfak Türü:</label>
    <input type="text" id="cuisine" name="cuisine"><br>

    <button type="submit">Ara</button>
</form>
