import { useState } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";

const Carousel = ({ images }) => {
  if (!images || images.length === 0) return null;

  return (
    <Swiper
      modules={[Navigation]}
      navigation={{
        nextEl: ".button-next",
        prevEl: ".button-prev",
      }}
      spaceBetween={10}
      slidesPerView={1}
      className="swiper-container relative"
    >
      {images.map((image, index) => (
        <SwiperSlide key={index} className="swiper-slide">
          <img
            className="rounded-t-md object-cover w-full h-[27.5vh]"
            src={`/storage/images/equipment/${image.path}`}
            alt=""
          />
        </SwiperSlide>
      ))}
      {/* Navigation Buttons */}
      <button className="button-next z-20 text-5xl flex items-center justify-center w-[3vw] h-[6vh] rounded-full absolute top-[50%] right-3 transform -translate-y-1/2">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 12 24">
          <path fill="currentColor" fillRule="evenodd" d="M10.157 12.711L4.5 18.368l-1.414-1.414l4.95-4.95l-4.95-4.95L4.5 5.64l5.657 5.657a1 1 0 0 1 0 1.414"/>
        </svg>
      </button>
      <button className="button-prev z-20 text-5xl flex items-center justify-center w-[3vw] h-[6vh] rounded-full absolute top-[50%] left-3 transform -translate-y-1/2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor" fillRule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z"/>
        </svg>
      </button>
    </Swiper>
  );
};

export default Carousel;
