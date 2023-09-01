import React, {useState, useEffect} from "react";
import {Cookies} from "react-cookie";

export default function Table(props) {
    const [lines, setLines] = useState(props.lines);
    //refresh lines every second
    useEffect(() => {
        const interval = setInterval(() => {
            //get lines from api
            let linesAPI = [];
            const urlLogs = 'http://127.0.0.1:8000/api/analytic/logs';
            fetch(urlLogs, {
                method: 'GET',
            })
                .then(response => response.json())
                .then(data => {
                    setLines(data);
                });
        }, 60000);
        return () => clearInterval(interval);
    }, []);


    return (
        <div className="flex flex-col">
            <div className="overflow-x-scroll">
                <div className=" w-full inline-block align-middle">
                    <div className="overflow-x-scroll overflow-y-scroll  border rounded-lg">
                        <table className="min-w-full divide-y overflow-scroll scroll-smooth hover:overflow-scroll divide-gray-200  ">
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
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    Method
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    Url
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    Port
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    Scheme
                                </th>
                                <th
                                    scope="col"
                                    className="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase "
                                >
                                    Body
                                </th>

                            </tr>
                            </thead>
                            <tbody className="divide-x overflow-scroll divide-gray-200 ">
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
                                                <td className="px-6 py-4 text-sm font-medium text-left whitespace-nowrap">
                                                    {line.port}
                                                </td>
                                                <td className="px-6 py-4 text-sm font-medium text-left whitespace-nowrap">
                                                    {line.scheme}
                                                </td>
                                                <td className="px-6 py-4 text-sm font-medium text-left whitespace-nowrap">
                                                    {line.body}
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
