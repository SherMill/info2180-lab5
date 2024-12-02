<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

if ($lookup == 'cities') {
  $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE ?");
  $stmt->execute(["%$country%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "<table><tr><th>Name</th><th>District</th><th>Population</th></tr>";
  foreach ($results as $row) {
      echo "<tr><td>{$row['name']}</td><td>{$row['district']}</td><td>{$row['population']}</td></tr>";
  }
  echo "</table>";
} else {
  $stmt = $conn->prepare("SELECT name, continent, indep_year, head_of_state FROM countries WHERE name LIKE ?");
  $stmt->execute(["%$country%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "<table><tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
  foreach ($results as $row) {
      echo "<tr><td>{$row['name']}</td><td>{$row['continent']}</td><td>{$row['indep_year']}</td><td>{$row['head_of_state']}</td></tr>";
  }
  echo "</table>";
}

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
