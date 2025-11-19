import { useState, useEffect } from "react";
import fetchData from '../../utils/functions';




const LandingPage = () => {
    const [data, setData] = useState<any[]>([]);

    useEffect(() => {
        const load = async () => {
            const coffee = await fetchData<any[]>("http://brewverse.test/api/coffee");
            if (coffee) setData(coffee);
        };

        load();
    }, []);


    return (

        <div className="container">
            {data.map((coffee) => (
                <p>{coffee.name}</p>
            ))}
        </div>
    )
}

export default LandingPage