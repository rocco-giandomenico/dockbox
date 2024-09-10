// On window load
window.addEventListener('load', function() {

    const newTheme = localStorage.getItem('theme') || document.documentElement.getAttribute('data-theme')
    setTheme(newTheme)

    // theme toggle
    document.getElementById('theme_toggle').addEventListener('click', function() {
        toggleTheme()
    })
})

// -----------------------------------------------------------------------------

function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme')
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark'
    setTheme(newTheme)

    
}

function setTheme(newTheme) {
    const el = document.getElementById('theme_toggle').children[0]

    if(newTheme == 'dark') {

        el.classList.remove('moon')
        el.classList.add('sun')

    } else {

        el.classList.remove('sun')
        el.classList.add('moon')

    }

    localStorage.setItem('theme', newTheme)
    document.documentElement.setAttribute('data-theme', newTheme)
    document.body.classList.remove('hidden')
}