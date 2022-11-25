function seoURL(url) {
    var url = url.toString().toLowerCase();
    url = url.split(/\&+/).join("-ve-")
    var turkce_karakterler = { 'ç': 'c', 'ğ': 'g', 'ü': 'u', 'ö': 'o', 'ş': 's', 'ı': 'i' };
    Object.keys(turkce_karakterler).forEach((key) => {
        url = url.split(key).join(turkce_karakterler[key]);
    })
    url = url.split(/[^a-z0-9]/).join("-");
    url = url.split(/-+/).join("-");
    url = url.trim('-');

    return url;
}