const toggleSidenavButton = document.getElementById('toggleSidenav')

if (toggleSidenavButton != null) {
    toggleSidenavButton.addEventListener('click', () => {
        document.body.classList.toggle('sidenav-toggled')
    })
}
