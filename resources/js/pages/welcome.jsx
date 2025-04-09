import { useAppearance } from '@/hooks/use-appearance';

export default function Welcome() {
    const { appearance } = useAppearance();

    return (
        <div className="min-h-screen ">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
            <nav className="px-20 py-4 flex items-center justify-between">
                <div className="flex items-center">
                    <div className="mr-2">
                        <img src="https://mylionsgeek.ma/logo1.png" alt="logo" className={`w-[22px] h-[22px] ${appearance === "dark" ? "invert" : ""}`} loading="lazy" />
                    </div>
                    <h1 className="text-xl lp:text-[20px] m-0 font-semibold ">Lions<span className="text-alpha">Geek</span>
                    </h1>
                </div>
                <div className="">
                    <a href="/login" className="rounded-md px-4 py-2 text-black bg-alpha">
                        Log in
                    </a>
                </div>
            </nav>

            <div className="flex justify-center gap-[12vw] items-center pt-20">
                <div className="w-[40%]">
                    <h1 className="text-4xl font-bold mb-6">
                        Easy Reservation For Equipment & Studios
                    </h1>
                    <p className="text-gray-400 text-base leading-relaxed mb-8">
                        We pride ourselves on providing you with a smooth and hassle-free experience when it comes <br /> to
                        booking equipment and studios for your creative projects. Whether you are an artist, musician, filmmaker
                        or content creator.
                    </p>
                    <button className="px-8 py-4 bg-alpha text-black rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                        Browse Spaces
                        <i className="fa-solid fa-right-long text-sm mt-1"></i>
                    </button>
                </div>
                <div>
                    <img src="https://mylionsgeek.ma/freind.png" alt="Hero" className="w-[36vw] mb-16" />
                </div>
            </div>

            <div className="flex justify-center items-center gap-[6rem] py-16">
                <div className={`border py-10 px-36 rounded-lg ${appearance === "dark" ? "border-alpha" : "border-gray-400"}`}>
                    <div className="flex items-center gap-4 mb-2">
                        <i className="fas fa-users text-xl text-alpha"></i>
                        <span className="text-3xl font-bold">1.0K+</span>
                    </div>
                    <p className="text-gray-400 text-sm">Active Members</p>
                </div>
                <div className={`border py-10 px-36 rounded-lg ${appearance === "dark" ? "border-alpha" : "border-gray-400"}`}>
                    <div className="flex items-center gap-4 mb-2">
                        <i className="fa-solid fa-grip text-2xl text-alpha"></i>
                        <span className="text-3xl font-bold">15+</span>
                    </div>
                    <p className="text-gray-400 text-sm">Creative Spaces</p>
                </div>
                <div className={`border py-10 px-36 rounded-lg ${appearance === "dark" ? "border-alpha" : "border-gray-400"}`}>
                    <div className="flex items-center gap-2 mb-2">
                        <i className="fa-solid fa-star text-xl text-alpha"></i>
                        <span className="text-3xl font-bold">4.9</span>
                    </div>
                    <p className="text-gray-400 text-sm">User Rating</p>
                </div>
            </div>

            <div className="grid grid-cols-2 px-20 py-20 gap-4">
                <div className={` p-6 rounded-2xl border ${appearance === "dark" ? "bg-[#2E2E2E]" : "border-alpha"}`}>
                    <i className="fa-solid fa-microphone text-alpha text-3xl mb-4"></i>
                    <h3 className="text-lg font-semibold mb-2">Recording Studios</h3>
                    <p className="text-gray-400 text-sm">Professional audio equipment and acoustically treated rooms</p>
                </div>
                <div className={` p-6 rounded-2xl border ${appearance === "dark" ? "bg-[#2E2E2E]" : "border-alpha"}`}>
                    <i className="fa-solid fa-camera text-alpha text-3xl mb-4"></i>
                    <h3 className="text-lg font-semibold mb-2">Photo Studios</h3>
                    <p className="text-gray-400 text-sm">High-end cameras and lighting equipment available</p>
                </div>
                <div className={` p-6 rounded-2xl border ${appearance === "dark" ? "bg-[#2E2E2E]" : "border-alpha"}`}>
                    <i className="fa-solid fa-desktop text-alpha text-3xl mb-4"></i>
                    <h3 className="text-lg font-semibold mb-2">Coworking Space</h3>
                    <p className="text-gray-400 text-sm">Comfortable workstations with high-speed internet</p>
                </div>
                <div className={` p-6 rounded-2xl border ${appearance === "dark" ? "bg-[#2E2E2E]" : "border-alpha"}`}>
                    <i className="fa-solid fa-video text-alpha text-3xl mb-4"></i>
                    <h3 className="text-lg font-semibold mb-2">Video Production</h3>
                    <p className="text-gray-400 text-sm">Full video production setup with green screen</p>
                </div>
            </div>

            <div className="py-20 px-20 ">
                <div className="text-center mb-12">
                    <h2 className="text-3xl font-bold mb-4">Featured Spaces</h2>
                    <p className="text-gray-400">Discover our most popular creative spaces and equipment.</p>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div className=" rounded-2xl overflow-hidden">
                        <img
                            src="https://lionsgeek.ma/static/media/audiovisuelle.9c3b0fc57f9a63fc2886.jpg"
                            alt="Recording Studio"
                            className="w-full h-48 object-cover"
                        />
                        <div className={` py-6 px-4 ${appearance === "dark" ? "bg-[#2E2E2E] px-6" : "bg-gray-100"}`}>
                            <h3 className="text-xl font-semibold mb-2">Podcast Studio</h3>
                            <p className="text-gray-400 text-sm mb-4">A fully equipped studio with professional audio recording and mixing equipment.</p>
                            <div>
                                <a href="#" className="px-4 py-3 bg-alpha/10 text-alpha rounded-lg hover:bg-alpha/20 transition-colors">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                    <div className=" rounded-2xl overflow-hidden">
                        <img src="https://media-hosting.imagekit.io//15adbca1a83a4a72/6596787b20a8d.jpg?Expires=1834864768&Key-Pair-Id=K2ZIVPTIP2VGHC&Signature=fcs2J35gMyNKjg8wp~NTixI~vNMXgWKyKpxs3fXKm7jerQFZ1N7-nMaYpkvG3A6MynGpbsxtH3ykCO2eEUrTkukcdK7jilY9KEGqC4ABd~ZRwxcBdfs3XRkPkY-PE-fHWHtSB3A-MRs6NwlLdAdAdlOQKJq0uVUGV-h0yebZrThbvvmnHbe28bKhIltD3B9gWCtJHEOONB99TvlLAKxZb4moXnWL-mpDCGj-3n9dFsoGHxgMXLWkYrI7EwtFlOXcku92h-J~-iiE70nYpE3SVRii1~rkEZ3CoqZBpK8Ba4DZOiK~sy7ajM56UfoLY4q0nbnXxHehv2jkSyfnFZVxMw__"
                            alt="Photo Studio"
                            className="w-full h-48 object-cover"
                        />
                        <div className={` py-6 px-4 ${appearance === "dark" ? "bg-[#2E2E2E] px-6" : "bg-gray-100"}`}>
                            <h3 className="text-xl font-semibold mb-2">Photo Studio</h3>
                            <p className="text-gray-400 text-sm mb-4">A professional studio with high-quality lighting and versatile backdrop options.</p>
                            <div>
                                <a href="#" className="px-4 py-3 bg-alpha/10 text-alpha rounded-lg hover:bg-alpha/20 transition-colors">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                    <div className=" rounded-2xl overflow-hidden">
                        <img
                            src="https://lh3.googleusercontent.com/p/AF1QipMGz4HoXyvK7HitvmR66V0-KjY-mYQWhMsIMx3b=s1360-w1360-h1020"
                            alt="Coworking Space"
                            className="w-full h-48 object-cover"
                        />
                        <div className={` py-6 px-4 ${appearance === "dark" ? "bg-[#2E2E2E] px-6" : "bg-gray-100 "}`}>
                            <h3 className="text-xl font-semibold mb-2">Coworking Space</h3>
                            <p className="text-gray-400 text-sm mb-4">A modern shared workspace featuring high-speed internet, and collaboration areas.</p>
                            <div>
                                <a href="#" className="px-4 py-3 bg-alpha/10 text-alpha rounded-lg hover:bg-alpha/20 transition-colors">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

