
<br>
<div class="saiz">
<center>
    <p>Ubah saiz</p>
    <input type="range" min="12" max="19" value="14" oninput="ubahSaiz(this.value)">
</center>
</div>
<br>

<style>
  .saiz{
    text-align: center;
    width: 380px;
    padding: 10px;
    border: 2px solid rgba(134, 81, 18, 0.92);
    border-radius: 15px 15px 15px 15px;
    margin: 0px auto;
    background-color: rgba(255, 255, 255, 0.85);
    box-shadow: 15px 15px 6px 0px rgba(78, 72, 72, 0.5);
  }
</style>

<script>
function ubahSaiz(saiz) {
  var elemen = document.getElementsByTagName("*");
  for (var i = 0; i < elemen.length; i++) {
      elemen[i].style.fontSize = saiz + "px";
  }
}
</script>

<!-- Footer sistem -->
<footer style="text-align: center; color: white; position: sticky; top: 100%">
  <!-- Paparan hak cipta -->
  Hak Cipta &copy; 2026 Sistem Undian Tema Dinner Rumah Merah.

</footer>