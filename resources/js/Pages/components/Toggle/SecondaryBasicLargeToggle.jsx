import React from "react"

export default function FormElementsToggleLgSecondaryBasic() {
  return (
    <>
      {/*<!-- Component: Lg sized secondary basic toggle button --> */}
      <div className="relative flex flex-wrap items-center">
        <input
          className="peer relative h-6 w-12 cursor-pointer appearance-none rounded-xl ring-2 ring-inset ring-slate-300 transition-colors after:absolute after:top-0 after:left-0 after:h-6 after:w-6 after:rounded-full after:bg-white after:ring-2 after:ring-inset after:ring-slate-500 after:transition-all checked:bg-emerald-200 checked:ring-emerald-500 checked:after:left-6 checked:after:bg-white checked:after:ring-emerald-500 hover:ring-slate-400 after:hover:ring-slate-600 checked:hover:bg-emerald-300 checked:hover:ring-emerald-600 checked:after:hover:ring-emerald-600  checked:focus:bg-emerald-400  checked:focus:ring-emerald-700 checked:after:focus:ring-emerald-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:border-slate-200 disabled:after:ring-slate-300"
          type="checkbox"
          value=""
          id="id-c04s"
        />
        <label
          className="cursor-pointer pl-2 text-slate-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400"
          htmlFor="id-c04s"
        >
          Secondary basic
        </label>
      </div>
      {/*<!-- End Lg sized secondary basic toggle button --> */}
    </>
  )
}
