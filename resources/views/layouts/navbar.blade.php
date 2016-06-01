<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
         
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
             <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button> <a class="navbar-brand" href="#">Daeng PetStore&#0153;</a>
    </div>
    
    <div class="collapse navbar-collapse" id="navbar-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ url('transaksi/create') }}"><span class="glyphicon glyphicon-plus-sign"></span> Buat Transaksi Baru</a>
            </li>
            <li>
                <a href="{{ url('pembeli') }}"><span class="glyphicon glyphicon-th-list"></span> Daftar Pembeli</a>
            </li>
            <li>
                <a href="{{ url('transaksi') }}"><span class="glyphicon glyphicon-th-list"></span> Transaksi</a>
            </li>
            <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Barang<strong class="caret"></strong>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('barang') }}"><span class="glyphicon glyphicon-th-list"></span> Lihat Daftar Barang</a>
                    </li>
                    <li>
                        <a href="{{ url('barang/create') }}"><span class="glyphicon glyphicon-plus-sign"></span> Input Barang</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
    });
</script>