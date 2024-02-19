import React from "react"

export default function FormElementsToggleLgPrimaryBasic() {
  return (
    <>
      {/*<!-- Component: Lg sized primary basic toggle button --> */}
      <div className="relative flex flex-wrap items-center">
        <input
          className="peer relative h-6 w-12 cursor-pointer appearance-none rounded-xl bg-slate-300 transition-colors after:absolute after:top-0 after:left-0 after:h-6 after:w-6 after:rounded-full after:bg-slate-500 after:transition-all checked:bg-emerald-200 checked:after:left-6 checked:after:bg-emerald-500 hover:bg-slate-400 after:hover:bg-slate-600 checked:hover:bg-emerald-300 checked:after:hover:bg-emerald-600 focus:outline-none checked:focus:bg-emerald-400 checked:after:focus:bg-emerald-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:bg-slate-200 disabled:after:bg-slate-300"
          type="checkbox"
          value=""
          id="id-c04"
        />
        <label
          className="cursor-pointer pl-2 text-slate-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400"
          htmlFor="id-c04"
        >
          Primary basic
        </label>
      </div>
      {/*<!-- End Lg sized primary basic toggle button --> */}
    </>
  )
}
