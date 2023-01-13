import React, { useCallback, useEffect, useRef, useState } from "react";
import { render } from "react-dom";
import {
	GoogleMap,
	InfoWindow,
	Marker,
	MarkerClusterer,
	useJsApiLoader,
} from "@react-google-maps/api";
import mapStyles from "./map-styles";
import states from "./states.json";

const stateNames = Object.values(states);
const stateAbbreviations = Object.keys(states);
const getStateName = (value) => {
	const val = value.replace(/[.,]*/g, "").toUpperCase();
	const index =
		(stateAbbreviations.indexOf(val) + 1 || stateNames.indexOf(val) + 1) -
		1;
	return index >= 0 ? stateNames[index] : false;
};

const geocodingApiKey = "AIzaSyDBUCaI5QSpC0UtgCMmpSxtgqKOUzhH-Ws";
const googleMapsLibraries = ["geometry"];

const metersPerMile = 1609.344;
const milesToMeters = (miles) => miles * metersPerMile;
const metersToMiles = (meters) => meters / metersPerMile;

const containerStyle = {
	width: "100%",
	height: "600px",
	maxHeight: "calc(100vh - 170px)",
};

const northAtlanticCenter = {
	lat: 37.2199793,
	lng: -54.164795,
};

const oldCenter = {
	lat: 41.0466125,
	lng: -81.5799542,
};

const center = northAtlanticCenter;

const markerIcon = {
	path: "M10 0A10 10 0 0 0 0 10c0 5.52 4 10.3 10 14.77C16.05 20.3 20 15.52 20 10A10 10 0 0 0 10 0Z",
	fillColor: "red" /* "#bf1e2e" */,
	fillOpacity: 1,
	strokeColor: "white",
	strokeWeight: 1,
	rotation: 0,
	anchor: { x: 10, y: 24.77 },
};

const markerIconBlue = {
	path: "M10 0A10 10 0 0 0 0 10c0 5.52 4 10.3 10 14.77C16.05 20.3 20 15.52 20 10A10 10 0 0 0 10 0Z",
	fillColor: "blue",
	fillOpacity: 1,
	strokeColor: "white",
	strokeWeight: 1,
	rotation: 0,
	anchor: { x: 10, y: 24.77 },
};

const DealerInfo = ({ dealer }) => {
	const {
		post_title: title,
		address = "",
		phone = "",
		location = {},
		distance,
	} = dealer;
	return (
		<div className="dealer">
			<h2 className="dealer__title h6 mb-2">{title}</h2>
			<address className="dealer__address">
				<a
					target="_blank"
					href={`https://maps.google.com/maps?saddr=My+Location&daddr=${(location &&
					location.address
						? location.address
						: address
					).replace(/\n/g, " ")}`}
					dangerouslySetInnerHTML={{
						__html: address.replace(/\n/g, "<br>"),
					}}
				/>
			</address>
			<p className="dealer__phone">
				{!phone.trim() ? null : <a href={`tel:${phone}`}>{phone}</a>}
			</p>
			{!distance ? null : (
				<p className="dealer__distance">
					{metersToMiles(distance).toFixed(1)} mi
				</p>
			)}
		</div>
	);
};

const DealerInfoWindow = ({ dealer, setActiveDealer }) => {
	const { location } = dealer || {};
	return !dealer ? null : (
		<InfoWindow
			position={{
				lat: location.lat,
				lng: location.lng,
			}}
			onCloseClick={() => setActiveDealer()}
		>
			<DealerInfo dealer={dealer} />
		</InfoWindow>
	);
};

const DealerMap = ({ clusterPath, dealers = [], googleMapsApiKey }) => {
	const { isLoaded } = useJsApiLoader({
		id: "google-map-script",
		googleMapsApiKey,
		libraries: googleMapsLibraries,
	});

	const bounds = useRef();
	const [map, setMap] = useState(null);
	const [activeDealer, setActiveDealer] = useState(null);

	const onLoad = useCallback(setMap, []);

	useEffect(() => {
		if (map) {
			bounds.current = new window.google.maps.LatLngBounds();
			const dealerCount = dealers.length;
			if (dealerCount) {
				const newActiveDealer =
					1 === dealerCount ? dealers[0] : undefined;
				setActiveDealer(newActiveDealer);
				dealers.forEach(({ location }) => {
					if (location)
						bounds.current.extend({
							lat: location.lat,
							lng: location.lng,
						});
				});
				map.fitBounds(bounds.current);
				if (map.getZoom() > 15) {
					map.setZoom(15);
				}
			} else {
				setActiveDealer();
			}
		}
	}, [map, dealers]);

	const onUnmount = useCallback(() => setMap(null), []);

	return isLoaded ? (
		<GoogleMap
			mapContainerStyle={containerStyle}
			center={center}
			zoom={10}
			onLoad={onLoad}
			onUnmount={onUnmount}
			options={{ styles: mapStyles }}
		>
			<MarkerClusterer
				options={{
					ignoreHidden: true,
					imagePath: clusterPath,
					imageExtension: "svg",
					minimumClusterSize: 6,
				}}
			>
				{(clusterer) =>
					dealers.map((dealer) => {
						const { location } = dealer;

						let markerIconUsed = null;

						//Change color of marker based on whether the country is US or international
						if (dealer.country === undefined) {
							markerIconUsed = markerIcon;
						} else {
							markerIconUsed = markerIconBlue;
						}

						return !location ? null : (
							<Marker
								key={`${location.lat}/${location.lng}`}
								icon={markerIconUsed}
								position={location}
								clusterer={clusterer}
								onClick={() => setActiveDealer(dealer)}
							/>
						);
					})
				}
			</MarkerClusterer>
			<DealerInfoWindow
				dealer={activeDealer}
				setActiveDealer={setActiveDealer}
			/>
		</GoogleMap>
	) : (
		<div
			className="py-sm lead text-center d-flex flex-column justify-content-center"
			style={containerStyle}
		>
			Loading map&hellip;
		</div>
	);
};

const DealerSearch = ({
	setError,
	searchLocation,
	setSearchLocation,
	searchState,
	setSearchState,
	chosenFilterOption,
	setChosenFilterOption,
}) => {
	const searchInput = useRef();

	const handleSubmit = useCallback(async (event) => {
		event.preventDefault();
		const address = (searchInput.current.value || "").trim();
		if (!address.length) {
			// show all
			setSearchLocation();
			setSearchState();
			setError();
		} else {
			const stateName = getStateName(address);
			try {
				const search = stateName
					? stateName.replace(/NEW YORK$/, "NEW YORK STATE")
					: address;
				const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${search}&key=${geocodingApiKey}`;
				const response = await fetch(url);
				if (!response.ok) {
					const error = new Error(
						response.statusText || response.status
					);
					error.response = response;
					throw error;
				}
				const { results } = await response.json();
				if (!results.length) {
					throw new Error("Location not found.");
				} else {
					const { bounds, location } = results[0].geometry;
					setSearchLocation({ ...location, ...bounds });
					setSearchState(stateName || undefined);
					setError();
				}
			} catch (e) {
				setSearchLocation();
				setSearchState();
				setError(e.message);
			}
		}
	});

	const [filterToggled, setFilterToggled] = useState(false);
	const filterOptions = [
		"Dealers",
		"Distributors",
		"Dealers and Distributors",
	];

	const optionClicked = (option) => {
		setChosenFilterOption(option.toLowerCase().slice(0, -1));
		setFilterToggled(false);
	};
	return (
		<form
			role="search"
			method="get"
			className="w-100 dealer-search search-form d-flex border-y border-light flex-column align-items-start"
			action="/dealers/"
			onSubmit={handleSubmit}
		>
			<label for="dealer-filter">
				Search for dealers and distributors.
			</label>
			<div className="d-flex w-100">
				<div className="dealer-search__input-wrap w-100">
					<input
						type="search"
						id="dealer-filter"
						className="form-control search-field w-100"
						aria-label="Enter a city, ZIP code, or street address to find nearby dealers."
						placeholder="City, ZIP code, or address"
						ref={searchInput}
						autoComplete="postal-code"
					/>
					{!searchLocation && !searchState ? null : (
						<button
							type="reset"
							className="btn btn-outline search-reset pl-1 pr-2 border-top border-bottom border-dark bg-white"
							aria-label="Reset"
							style={{ marginLeft: -1, borderLeftWidth: 0 }}
							onClick={() => {
								searchInput.current.value = "";
								setSearchLocation();
								setSearchState();
								setError();
							}}
						>
							&times;
						</button>
					)}
				</div>
				<button
					type="submit"
					className="btn btn-dark text-uppercase search-submit"
				>
					Search
				</button>
				<div className="position-relative">
					<button
						onClick={() => setFilterToggled(!filterToggled)}
						type="button"
						className="h-100 ml-4 btn-outline bg-white py-0 "
					>
						Filter by{" "}
						{chosenFilterOption && chosenFilterOption + "s"}
						<svg
							style={
								filterToggled && { transform: "rotate(180deg)" }
							}
							className="ml-2"
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							fill="none"
						>
							<path
								stroke="#0E0E0E"
								stroke-width="2"
								d="m3 8 9 9 9-9"
							/>
						</svg>
					</button>
					{filterToggled && (
						<div
							style={{ whiteSpace: "nowrap", zIndex: 100 }}
							className="position-absolute ml-4 mt-4 px-4 border border-black bg-white"
						>
							{filterOptions.map((option, index) => {
								return (
									<div
										key={index}
										style={{ cursor: "pointer" }}
										onClick={() => optionClicked(option)}
										className={`py-3 ${
											index === 1 &&
											"border-top border-bottom border-black"
										}`}
									>
										{option}
									</div>
								);
							})}
						</div>
					)}
				</div>
			</div>
		</form>
	);
};

const Dealers = ({ clusterPath, dealers, googleMapsApiKey }) => {
	const [error, setError] = useState();

	// Search States
	const [searchState, setSearchState] = useState();
	const [searchLocation, setSearchLocation] = useState();
	const [chosenFilterOption, setChosenFilterOption] = useState();

	// List of Dealers/Distributors States
	const [filteredDealers, setFilteredDealers] = useState();
	const [domesticDealers, setDomesticDealers] = useState();
	const [intlDealers, setIntlDealers] = useState();

	useEffect(() => {
		const filteredDealers =
			!searchLocation && !searchState && !chosenFilterOption
				? dealers
				: dealers.filter((dealer) => {
						const { location } = dealer;
						const { lat, lng, state } = location || {};
						const passesFilterOption =
							chosenFilterOption !== "dealer" &&
							chosenFilterOption !== "distributor"
								? true
								: chosenFilterOption === dealer.post_type;

						// return false early if possible
						if ((!state || !searchState) && (!lat || !lng))
							return false;

						// if user searchced for a state name or abbreviation, just show results in that state
						if (searchState) {
							dealer.distance = undefined;
							return (
								state &&
								searchState === state.toUpperCase() &&
								passesFilterOption
							);
						}

						if (searchLocation) {
							// otherwise show results within a given radius of the search location
							const milesRadius = 100;
							const metersRadius = milesToMeters(milesRadius);
							dealer.distance =
								google.maps.geometry.spherical.computeDistanceBetween(
									{ lat, lng },
									searchLocation
								);
							return (
								dealer.distance < metersRadius &&
								passesFilterOption
							);
						}

						return passesFilterOption;
				  });
		setFilteredDealers(filteredDealers);
	}, [dealers, searchLocation, searchState, chosenFilterOption]);

	useEffect(() => {
		let domesticDealers = [];
		let intlDealers = {};

		filteredDealers.forEach((d) => {
			if (d.country !== undefined && d.country !== "united-states") {
				if (!intlDealers[d.country]) {
					intlDealers[d.country] = [];
				}

				intlDealers[d.country].push(d);
			} else {
				domesticDealers.push(d);
			}
		});

		setDomesticDealers(domesticDealers);
		setIntlDealers(intlDealers);
	}, [dealers, filteredDealers]);

	const iterateDomesticDealers = () => {
		let dom = [];

		domesticDealers
			.sort(({ distance: aDist = 0 }, { distance: bDist = 0 }) => {
				return aDist - bDist;
			})
			.map((dealer) =>
				dom.push(
					<div className="col-sm-6 col-md-4 col-lg-3 pb-sm">
						<DealerInfo dealer={dealer} />
					</div>
				)
			);

		return <div className="row dealer-search__row my-xs">{dom}</div>;
	};

	const iterateInternationalDealers = (country) => {
		const countryDealers = country[1];
		const dealers = [];

		countryDealers.forEach((d) => {
			dealers.push(<DealerInfo dealer={d} />);
		});

		return <div className="col px-0">{dealers}</div>;
	};

	const iterateCountries = () => {
		const countries = [];

		Object.entries(intlDealers).map((country) => {
			countries.push(
				<div className="col-sm-6 col-md-4 col-lg-3 pb-sm">
					<h4> {country[0]} </h4>

					{iterateInternationalDealers(country)}
				</div>
			);
		});

		return <div className="row dealer-search__row my-xs">{countries}</div>;
	};

	return (
		<div className="dealer-search__inner">
			{!googleMapsApiKey ? null : (
				<div className="alignfull">
					<DealerMap
						{...{
							clusterPath,
							dealers: filteredDealers,
							googleMapsApiKey,
						}}
					/>
					<div className="py-sm border-top border-bottom border-dark">
						<div className="container">
							<div>
								<DealerSearch
									{...{
										setError,
										searchLocation,
										setSearchLocation,
										searchState,
										setSearchState,
										chosenFilterOption,
										setChosenFilterOption,
									}}
								/>
							</div>
						</div>
					</div>
					{!error ? null : (
						<div
							className="alert alert-danger"
							style={{ marginTop: -1 }}
							role="alert"
						>
							<div className="container">{error}</div>
						</div>
					)}
				</div>
			)}

			{(!domesticDealers || !domesticDealers.length) &&
			(!intlDealers || !Object.entries(intlDealers).length) ? (
				<div className="col py-sm">
					<p className="text-center h3 mb-0">No results found.</p>
				</div>
			) : (
				""
			)}

			{!domesticDealers || !domesticDealers.length ? (
				""
			) : (
				<details
					class="dealer-wrap"
					open={!intlDealers || !Object.entries(intlDealers).length}
				>
					<summary>
						<h2>US Dealers</h2>
					</summary>
					{iterateDomesticDealers()}
				</details>
			)}

			{!intlDealers || !Object.entries(intlDealers).length ? (
				""
			) : (
				<details
					class="dealer-wrap"
					open={!domesticDealers || !domesticDealers.length}
				>
					<summary>
						<h2>International Dealers and Distributors</h2>
					</summary>
					{iterateCountries()}
				</details>
			)}
		</div>
	);
};

const el = document.getElementById("dealer-search");
if (el) {
	const { clusterPath, dealers, googleMapsApiKey } = el.dataset;
	const parsedDealers = JSON.parse(dealers || "[]");
	render(
		<Dealers
			clusterPath={clusterPath}
			dealers={parsedDealers}
			googleMapsApiKey={googleMapsApiKey}
		/>,
		el
	);
}
