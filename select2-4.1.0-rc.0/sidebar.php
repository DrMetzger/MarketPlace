<?php 
if(session_id() == '') {
	session_start();
	}
    require("action/seguro.php");  

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	
<script type="text/javascript">
	$(document).ready(function(){
		$("#menu a").click(function( e ){
            $("#loading").fadeIn('slow'); // Exibi o loading antes da requisição

            e.preventDefault();
			var href = $( this ).attr('href');
			$("#content").load( href +" #content", function() {
                $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                });
                $("#loading").fadeOut('slow');
            });
		});




	});
    
</script>

<style>
    #loading {
    display:none;
    position:fixed;
    top:0;
    left:0;
    background-color:rgba(0,0,0,0.9);
    width:100%;
    height:100%;
    overflow:hidden;
    padding:200px 0;
    margin:0;
    text-align:center;
    z-index: 2;
}

#circle {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
	width: 150px;
    height: 150px;	
    z-index: 2;
}

.loader {
    width: calc(100% - 0px);
	height: calc(100% - 0px);
	border: 8px solid #162534;
	border-top: 8px solid #09f;
	border-radius: 50%;
	animation: rotate 5s linear infinite;
    z-index: 2;
}

@keyframes rotate {
100% {transform: rotate(360deg);}
} 
</style>

<div id="loading">
<div id="circle">
  <div class="loader">
    <div class="loader">
        <div class="loader">
           <div class="loader">

           </div>
        </div>
    </div>
  </div>
  <span><h3>Carregando...</h3></span>
</div> 

</div>


<!-- Sidebar -->

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="https://www.primeerp.com.br/nfeprime/portal.php">
    <div class="sidebar-brand-icon">
    <img src="img/LOGO-P.png" width=100% height=50%>
    </div>
    <div><img src="img/lado_direito_logo_prime.png" width=100% height=50%></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li id="menu" class="nav-item active">
    <a class="nav-link" href="https://www.primeerp.com.br/nfeprime/portal.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <i class="fa-solid fa-cart-shopping"></i>
        <span>Dashboard
        </span></a>        
</li>




<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Atualizações
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-shopping-bag"></i>
        <span>Produtos</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div id="menu" class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="https://www.primeerp.com.br/nfeprime/produtos.php">Produtos</a>
            <a class="collapse-item" href="cards.html">Tipo</a>
            <a class="collapse-item" href="cards.html">Unidade Medida</a>
            <a class="collapse-item" href="cards.html">Armazém</a>
            <a class="collapse-item" href="cards.html">N.C.M</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2"
        aria-expanded="true" aria-controls="collapseTwo2">
        <i class="fas fa-fw fa-users"></i>
        <span>Clientes/Fornecedores</span>
    </a>
    <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div id="menu" class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="https://www.primeerp.com.br/nfeprime/produtos.php">Clientes</a>
            <a class="collapse-item" href="cards.html">Tipo de Entrada/Saída</a>
            <a class="collapse-item" href="cards.html">Natureza</a>
            <a class="collapse-item" href="cards.html">Condição de Pagamento</a>
            <a class="collapse-item" href="cards.html">Municípios</a>
            <a class="collapse-item" href="cards.html">Impostos</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider">

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Dados da Empresa</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div id="menu" class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Filiais:</h6>
            <a class="collapse-item" href="https://www.primeerp.com.br/nfeprime/newfilial.php">Nova Filial</a>
            <a class="collapse-item" href="utilities-border.html">Manutenção Filiais</a>
        </div>
    </div>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->