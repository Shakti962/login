    function openNav() {
        document.getElementById("sideNav").style.width = "100%";
    }

    function closeNav() {
        if (screen.width <= 991) {
            document.getElementById("sideNav").style.width = "0";
        }
    }