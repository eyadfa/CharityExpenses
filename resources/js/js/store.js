
const updateAbilities = (store) => {
   // ability.update(store.state.rules) // take rules from your state structure

    return store.subscribe((mutation) => {
        switch (mutation.type) {
            case 'login':
                ability.update(mutation.payload.rules)
                break
            case 'logout':
                ability.update([{ actions: 'read', subject: 'all' }]) // read only mode
                // or `ability.update([])` to remove all permissions
                break
        }
    })
}

export default new Vuex.Store({
    plugins: [
        updateAbilities
    ],
    // ... your store declaration
})
