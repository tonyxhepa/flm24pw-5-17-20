module.exports = {
    theme: {
        extend: {
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            }
        },
        spinner: (theme) => ({
            default: {
                color: '#5a67d8', // color you want to make the spinner
                size: '1em', // size of the spinner (used for both width and height)
                border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
                speed: '500ms', // the speed at which the spinner should rotate
            },
        }),
    },
    variants: {
        spinner: ['responsive'],
    },
    plugins: [
        require('tailwindcss-spinner')(),
    ],
}
