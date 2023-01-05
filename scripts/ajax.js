const getGuests = async (filter = {}) => {
    const data = new URLSearchParams();
    for (let key in filter) 
        data.append(key, filter[key]);
    
    return fetch(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}ajax/getGuests.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data
    }).then((response) => response.json());
}

const getGuestById = async (id) => fetch(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}ajax/getGuestById.php?id=${id}`).then((response) => response.json());

const postGuest = async (guest) => {
    const data = new URLSearchParams();
    for (let key in guest) 
        data.append(key, guest[key]);

    return fetch(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}ajax/postGuest.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data
    }).then((response) => response.json());
}
const getBackupDatetime = async () => fetch(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}ajax/getBackupDatetime.php`).then((response) => response.json());
const postBackupDatetime = async () => fetch(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}ajax/postBackupDatetime.php`).then((response) => response.json());

const getTopics = async () =>
    fetch(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}ajax/getTopics.php`)
        .then((response) => response.json());