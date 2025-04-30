import { useState, useRef } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';

export default function ScreenRecorder() {
  const [recording, setRecording] = useState(false);
  const [videoURL, setVideoURL] = useState(null);
  const mediaRecorderRef = useRef(null);
  const chunksRef = useRef([]);

  const startRecording = async () => {
    try {
      const stream = await navigator.mediaDevices.getDisplayMedia({
        video: true,
        audio: {
          autoGainControl: false,
          echoCancellation: false,
          noiseSuppression: false,
          sampleRate: 44100,
          suppressLocalAudioPlayback: false,
          channelCount: 2,
        },
      });

      mediaRecorderRef.current = new MediaRecorder(stream);

      mediaRecorderRef.current.ondataavailable = (event) => {
        if (event.data.size > 0) {
          chunksRef.current.push(event.data);
        }
      };

      mediaRecorderRef.current.onstop = () => {
        const blob = new Blob(chunksRef.current, { type: 'video/webm' });
        const url = URL.createObjectURL(blob);
        setVideoURL(url);
        chunksRef.current = [];
      };

      mediaRecorderRef.current.start();
      setRecording(true);
    } catch (error) {
      console.error('Error starting screen recording:', error);
    }
  };

  const stopRecording = () => {
    if (mediaRecorderRef.current) {
      mediaRecorderRef.current.stop();
      setRecording(false);
    }
  };

  return (
    <>
      <DefaultLayout>
        <Breadcrumb pageName="Screen Recorder" />
        <div className="flex flex-col items-center gap-4 p-4">
          <h2 className="text-xl font-bold">Screen Recorder</h2>
          <div className="flex gap-2">
            {!recording ? (
              <button
                onClick={startRecording}
                className="bg-green-500 p-4 rounded-md"
              >
                Start Recording
              </button>
            ) : (
              <button
                onClick={stopRecording}
                className="bg-red-500 p-4 rounded-md"
              >
                Stop Recording
              </button>
            )}
          </div>
          {videoURL && (
            <div className="mt-4">
              <video src={videoURL} controls className="w-full max-w-md" />
              <a
                href={videoURL}
                download="recorded-video.webm"
                className="block mt-2 text-center text-white p-4 rounded-md bg-blue-500"
              >
                Download Video
              </a>
            </div>
          )}
        </div>
      </DefaultLayout>
    </>
  );
}
