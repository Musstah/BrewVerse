
async function fetchData<T>(url: string): Promise<T | undefined> {
    try {
        const res = await fetch(url);
        if (res.ok) {
            const data = await res.json();
            return data as T;
        }
    } catch (error) {
        console.log(error);
    }
}

export default fetchData