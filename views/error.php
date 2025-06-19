{{ include('layouts/header.php', {title: 'Error'})}}
 <div class="conatiner">
      <div class="section_erreur">
         <h2 >Error</h2>
         <strong class="error">{{ message }}</strong>
      </div>
 </div>
{{ include('layouts/footer.php')}}