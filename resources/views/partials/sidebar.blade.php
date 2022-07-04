<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menu</div>
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Main Menu</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    CRM
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/opportunity/">Cek Opportunity (23.175)</a>
                        <a class="nav-link" href="/antrian/">Cek Antrian(23.175)</a>
                        <a class="nav-link" href="/spa/">Cek No SPA (23.193)</a>
                        <a class="nav-link" href="/spa/spaSync">Cek Sync SPA Staging (23.193)</a>
                        <a class="nav-link" href="/staging/">Cek SPA Staging (23.58)</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseLayoutsspa" aria-expanded="false" aria-controls="collapseLayoutsspa">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    SAP
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayoutsspa" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/sap">Cek IO</a>
                    </nav>
                </div>
                {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a> --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePM2"
                    aria-expanded="false" aria-controls="collapsePM2">
                    <div class="sb-nav-link-icon"><i class="fas fa-tv"></i></div>
                    PM2 Monitoring
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePM2" aria-labelledby="headingOne" data-bs-parent="#dropdownPM2">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/pm2/send-pa-crm">Send PA CRM</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Created By</div>
            Mr. Narendro
        </div>
    </nav>
</div>
