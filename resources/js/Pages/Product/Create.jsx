import { useState } from "react";
import { Link, useForm } from "@inertiajs/react";

export default function Create({ categories, roomtypes }) {

    const { data, setData, post, processing, errors } = useForm({
        name: "",
        description: "",
        price: "",
        stock_quantity: "",
        image_url: "",
        category_id: "",
        roomtype_id: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('products.store'));
    };

    return (
        <div className="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
            <h1 className="text-2xl font-bold text-gray-800 mb-6">➕ Add New Product</h1>

            <form onSubmit={handleSubmit}>

                {/* Name Field */}
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">Product Name</label>
                    <input
                        type="text"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    />
                    {errors.name && <p className="text-red-500 text-sm mt-1">{errors.name}</p>}
                </div>

                {/* Description Field */}
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea
                        value={data.description}
                        onChange={(e) => setData("description", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    />
                    {errors.description && <p className="text-red-500 text-sm mt-1">{errors.description}</p>}
                </div>

                {/* Price Field */}
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">Price</label>
                    <input
                        type="number"
                        value={data.price}
                        onChange={(e) => setData("price", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    />
                    {errors.price && <p className="text-red-500 text-sm mt-1">{errors.price}</p>}
                </div>

                {/* Stock Field */}
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">Stock</label>
                    <input
                        type="number"
                        value={data.stock_quantity}
                        onChange={(e) => setData("stock_quantity", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    />
                    {errors.stock_quantity && <p className="text-red-500 text-sm mt-1">{errors.stock_quantity}</p>}
                </div>

                {/* Image URL Field */}
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">Image URL</label>
                    <input
                        type="text"
                        value={data.image_url}
                        onChange={(e) => setData("image_url", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    />
                    {errors.image_url && <p className="text-red-500 text-sm mt-1">{errors.image_url}</p>}
                </div>

                {/* Category Field */}
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">Category</label>
                    <select
                        value={data.category_id}
                        onChange={(e) => setData("category_id", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    >
                        <option value="">Select Category</option>
                        {categories.map(category => (
                            <option key={category.id} value={category.id}>
                                {category.name}
                            </option>
                        ))}
                    </select>
                </div>

                {/* RoomType Field */}
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">RoomType</label>
                    <select
                        value={data.roomtype_id}
                        onChange={(e) => setData("roomtype_id", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                    >
                        <option value="">Select RoomType</option>
                        {roomtypes.map(roomtype => (
                            <option key={roomtype.id} value={roomtype.id}>
                                {roomtype.name}
                            </option>
                        ))}
                    </select>
                </div>

                {/* Buttons */}
                <div className="flex items-center gap-3">
                    <button
                        type="submit"
                        disabled={processing}
                        className="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition disabled:opacity-50"
                    >
                        ✅ Save Product
                    </button>
                    <Link
                        href="/products"
                        className="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition"
                    >
                        ❌ Cancel
                    </Link>
                </div>
            </form>
        </div>
    );
}
