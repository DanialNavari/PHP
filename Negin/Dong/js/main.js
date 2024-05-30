function page(type, route) {
    if (type == 'r') {
        window.location.assign('./?route=' + route);
    } else if (type == 'd') {
        window.location.assign(route);
    }
}