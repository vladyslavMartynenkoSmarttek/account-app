import React from "react"
import {ComposableMap, Geographies, Geography, Marker, ZoomableGroup} from "react-simple-maps"

const geoUrl = "https://raw.githubusercontent.com/deldersveld/topojson/master/world-countries.json"



export default function MapChart(mapMarkers) {

    const [lat, setLat] = React.useState(0);
    const [lang, setLang] = React.useState(0);
//get position
    navigator.geolocation.getCurrentPosition(function (position) {
        setLat(position.coords.latitude);
        setLang(position.coords.longitude);
    });

    console.log(mapMarkers)

    //create state position
    return (
        <ComposableMap>
            <ZoomableGroup center={[48.3794, 31.1656]} zoom={3}>
                <Geographies geography={geoUrl}>
                    {({geographies}) =>
                        geographies.map((geo) => (
                            <Geography key={geo.rsmKey} geography={geo}/>
                        ))
                    }
                </Geographies>

                <Marker coordinates={[lang, lat]}>
                    <circle r={1} fill="#F53"/>
                </Marker>

                {(mapMarkers.mapMarkers).map((marker, i) => (
                    <Marker key={i} coordinates={[marker.lng, marker.lat]}>
                        <circle r={1} fill="#F53"/>
                    </Marker>
                ))}

            </ZoomableGroup>
        </ComposableMap>
    )
}
