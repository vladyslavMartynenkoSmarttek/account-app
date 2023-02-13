import React, {useState, useEffect} from "react";
import {Cookies} from "react-cookie";

export default function Table(props) {
    const [lines, setLines] = useState(props.lines);
    //refresh lines every second
    useEffect(() => {
        const interval = setInterval(() => {
            //get lines from api
            let linesAPI = [];
            fetch('http://45.89.88.115/api/analytic/logs', {
                method: 'GET',
            })
                .then(response => response.json())
                .then(data => {
                    setLines(data);
                });
        }, 1000);
        return () => clearInterval(interval);
    }, []);


    return (
        <div className="flex flex-col">
            <div className="overflow-x-auto">
                <div className=" w-full inline-block align-middle">
                    <div className="overflow-hidden border rounded-lg">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    ID
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    IP
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    Date
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase "
                                >
                                    Method
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase "
                                >
                                    Url
                                </th>
                            </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200">
                            {
                                lines.map((line, index) => {
                                    if (line.ip) {
                                        return (
                                            <tr key={index + 1}>
                                                <td className="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                                    {index + 1}
                                                </td>
                                                <td className="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                    {line.ip}
                                                </td>
                                                <td className="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                    {line.date}
                                                </td>
                                                <td className="px-6 py-4 text-sm font-medium text-left whitespace-nowrap">
                                                    {line.method}
                                                </td>
                                                <td className="px-6 py-4 text-sm font-medium text-left whitespace-nowrap">
                                                    {line.url}
                                                </td>
                                            </tr>
                                        );
                                    }
                                })
                            }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
}
