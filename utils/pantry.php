
<style>
  .pantry{
    position: fixed;
    max-height: 50%;
    min-height: 30%;
    width: 200px;
    top: calc((100% - 50%) / 2);
    right: 0px;
    background-color: #c6f7be;
    border-radius: 20px 0px 0px 20px;
    border: 1px brown dashed;
    overflow-y: scroll;
    box-shadow: 0px 0px 10px black;  
    scrollbar-width: none;
    z-index: 10;
  }
  .pantry::-webkit-scrollbar {
    width: 5px;
  }
  .pantry::-webkit-scrollbar-track {
    background-color: lightgrey;
  }

  .pantry::-webkit-scrollbar-thumb {
    background-color: grey;
    border-radius: 5px;
  }

  .pantry ul{
    list-style: none;
    padding: 5px;
  }

  .pantry li{
    border-bottom: dashed brown 1px;
  }

  .pantry span{
    cursor: pointer;
  }
</style>
<script>
  function remove(id){
    var element = document.getElementById(id);
    element.parentNode.removeChild(element);
    fetchRecipes();
  }
</script>
<div class="pantry">
  <center><b>My Pantry</b></center>
  <ul></ul>
</div>