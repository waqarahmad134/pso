import React, { useState } from "react";
import axios from "axios";

const UploadVideo = () => {
  const [video, setVideo] = useState(null);
  const [logo, setLogo] = useState(null);
  const [loading, setLoading] = useState(false);
  const [downloadUrl, setDownloadUrl] = useState(null);
  const [error, setError] = useState(null);

  const handleVideoChange = (event) => {
    setVideo(event.target.files[0]);
  };

  const handleLogoChange = (event) => {
    setLogo(event.target.files[0]);
  };

  const handleUpload = async () => {
    if (!video || !logo) {
      setError("Please select both video and logo.");
      return;
    }

    setLoading(true);
    setError(null);
    setDownloadUrl(null);

    const formData = new FormData();
    formData.append("video", video);
    formData.append("logo", logo);

    try {
      const response = await axios.post("http://localhost:5000/upload", formData, {
        responseType: "blob",
      });

      const videoBlob = new Blob([response.data], { type: "video/mp4" });
      const videoUrl = URL.createObjectURL(videoBlob);
      setDownloadUrl(videoUrl);
    } catch (err) {
      setError("Failed to process the video.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="flex flex-col items-center justify-center bg-gray-100 p-6">
      <div className="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
        <h2 className="text-xl font-semibold mb-4">Upload Video & Logo</h2>

        <input type="file" accept="video/*" onChange={handleVideoChange} className="mb-3 w-full p-2 border rounded" />
        <input type="file" accept="image/png" onChange={handleLogoChange} className="mb-3 w-full p-2 border rounded" />

        <button
          onClick={handleUpload}
          className="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition"
          disabled={loading}
        >
          {loading ? "Processing..." : "Upload & Add Logo"}
        </button>

        {error && <p className="text-red-500 mt-3">{error}</p>}

        {downloadUrl && (
          <div className="mt-4">
            <video controls src={downloadUrl} className="w-full rounded"></video>
            <a href={downloadUrl} download="processed_video.mp4" className="block mt-2 text-blue-600 underline">
              Download Video
            </a>
          </div>
        )}
      </div>
    </div>
  );
};

export default UploadVideo;
