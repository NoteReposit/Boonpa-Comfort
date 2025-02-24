import { useForm } from "@inertiajs/react";

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/roomtypes");
    };

    return (
        <div className="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
            <h1 className="text-2xl font-bold text-gray-800 mb-6">➕ Add Room Type</h1>

            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <label className="block text-gray-700 font-medium mb-2">Room Type Name</label>
                    <input
                        type="text"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        className="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
                        required
                    />
                    {errors.name && <p className="text-red-500 text-sm mt-1">{errors.name}</p>}
                </div>

                <div className="flex items-center gap-3">
                    <button
                        type="submit"
                        disabled={processing}
                        className="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition disabled:opacity-50"
                    >
                        ✅ Save Room Type
                    </button>
                    <a
                        href="/roomtypes"
                        className="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition"
                    >
                        ❌ Cancel
                    </a>
                </div>
            </form>
        </div>
    );
}
