<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>IB</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Men</b> in black</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <chat-notification></chat-notification>
                <chat-box v-if="this.$store.state.showChatBox"></chat-box>
                @include('partial.userDropDown')

            </ul>
        </div>

    </nav>
</header>

