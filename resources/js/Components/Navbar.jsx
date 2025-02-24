import React from "react";
import { Link } from "@inertiajs/react";

const Navbar = () => {
  return (
    <nav className="bg-amber-950 text-white p-4 flex justify-between">
      <h1 className="text-xl font-bold">Boonpa Comfort</h1>
      <ul className="flex gap-4">
        <li><Link href="/">Home</Link></li>
        <li><Link href="/product">Products</Link></li>
        <li><Link href="/cart">Cart</Link></li>
        <li><Link href="/profile">Profile</Link></li>
      </ul>
    </nav>
  );
};

export default Navbar;
