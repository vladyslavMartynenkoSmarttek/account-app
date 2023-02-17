//create component for select
import React from "react";

export const Select = ({name, label, options, error,value, ...rest}) => {
    return (
        <div className="form-group">
            {error && <div className="alert alert-danger">{error}</div>}
            <label htmlFor={name} className="block mb-2 text-sm font-medium text-gray-900 ">{label}</label>
            <select  id={name} {...rest} value={value}  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                {options.map((option,index) => (
                    <option key={option.id} value={option.name}   >
                        {option.name}
                    </option>
                ))}
            </select>
        </div>

    );
};
