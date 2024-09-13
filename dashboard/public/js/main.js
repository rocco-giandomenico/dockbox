// On window load
window.addEventListener('load', function() {

    // theme toggle
    document.getElementById('theme_toggle').addEventListener('click', function() {
        toggleTheme()
    })
})

// -----------------------------------------------------------------------------

// Toggle Theme
function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme')
    const newTheme = currentTheme === 'dark' ? 'ligth' : 'dark'
    setTheme(newTheme)
}

// Set Theme
function setTheme(newTheme) {

    // Get theme and set toggle icons
    const el = document.getElementById('theme_toggle').children[0]

    el.classList.toggle('dark')
    el.classList.toggle('ligth')

    // Get expiration time () and set cookie/theme
    const date = new Date()
    date.setDate(date.getDate() + 400)

    document.cookie = 'theme=' + newTheme + '; expires=' + date.toUTCString()
    document.documentElement.setAttribute('data-theme', newTheme)
}