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

    // get expiration time
    let now = new Date()
    const expireTime  = now.getTime() + 200000000000
    now.setTime(expireTime)

    // get theme
    const el = document.getElementById('theme_toggle').children[0]

    // set togglr icon
    if(newTheme == 'dark') {

        el.classList.remove('moon')
        el.classList.add('sun')

    } else {

        el.classList.remove('sun')
        el.classList.add('moon')

    }

    // set cookie and theme
    document.cookie = 'theme=' + newTheme + '; expires=' + now.toUTCString()
    document.documentElement.setAttribute('data-theme', newTheme)
}