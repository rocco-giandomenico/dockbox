// On window load
window.addEventListener('load', function() {

    window.addEventListener('click', function(e) {

        switch(e.target.dataset.type) {
            case 'theme_toggle':
                resetMenu()
                toggleTheme(e.target)
                break
            
            case 'dropdown':
                menuToggle(e.target)
                break

            default:
                resetMenu()
                break
        }
        
    })

})

// -----------------------------------------------------------------------------

// Toggle Theme
function toggleTheme(el) {
    const currentTheme = document.documentElement.getAttribute('data-theme')
    const newTheme = currentTheme === 'dark' ? 'ligth' : 'dark'
    setTheme(newTheme, el)
}

// Set Theme
function setTheme(newTheme, el) {

    el.classList.toggle('dark')
    el.classList.toggle('ligth')

    // Get expiration time () and set cookie/theme
    const date = new Date()
    date.setDate(date.getDate() + 400)

    document.cookie = 'theme=' + newTheme + '; expires=' + date.toUTCString()
    document.documentElement.setAttribute('data-theme', newTheme)

}

// Info Menu Toggle
function menuToggle(el) {
    el.parentElement.children[1].classList.toggle('hidden')
    el.classList.toggle('selected')
}

function resetMenu() {

    const menu_array = document.querySelectorAll('[data-type="dropdown"]')

    menu_array.forEach(e => {
        e.parentElement.children[1].classList.add('hidden')
        e.classList.remove('selected')
    })


}
