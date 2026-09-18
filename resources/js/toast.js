Nova.booting(() => {
    const toast = Nova.config('novaToast')

    if (!toast || !toast.message) {
        return
    }

    const type = ['success', 'error', 'warning', 'info'].includes(toast.type) ? toast.type : 'info'

    Nova[type](toast.message)
})
