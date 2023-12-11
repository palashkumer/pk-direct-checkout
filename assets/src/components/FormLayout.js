import React, { useState } from "react";
import axios from "axios";

const FormLayout = () => {
  const [formValues, setFormValues] = useState({
    buy_now_button_label: "Buy Now",
    buy_now_button_color: "#0073e5",
    buy_now_font_color: "#ffffff",
    buy_now_font_size: 16,
  });

  const [showSuccessMessage, setShowSuccessMessage] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormValues({
      ...formValues,
      [name]: value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post(
        "/wp-json/pkdc/v1/save-options/",
        formValues,
        {
          headers: {
            "Content-Type": "application/json",
            "X-WP-Nonce": pkdcSettings.nonce,
          },
        }
      );

      console.log("Response:", response.data);

      // Show success message
      setShowSuccessMessage(true);

      setTimeout(() => {
        setShowSuccessMessage(false);
      }, 2000);
    } catch (error) {
      console.error("Error:", error);
    }
    setFormValues((prevFormValues) => {
      console.log("Updated State:", prevFormValues);
      return prevFormValues;
    });
  };

  return (
    <div className="wrap">
      <h2 className="settings-title"> Direct Checkout Button Setting </h2>
      <form className="form-container" onSubmit={handleSubmit}>
        <div className="pkdc-input-field">
          <label className="pkdc-label" htmlFor="buy_now_button_label">
            Buy Now Button Label
          </label>
          <input
            type="text"
            className="input-box-style"
            name="buy_now_button_label"
            id="buy_now_button_label"
            value={formValues.buy_now_button_label}
            onChange={handleChange}
          />
        </div>

        <div className="pkdc-input-field">
          <label className="pkdc-label" htmlFor="buy_now_button_color">
            Button Color
          </label>
          <input
            type="color"
            className="input-box-style"
            name="buy_now_button_color"
            id="buy_now_button_color"
            value={formValues.buy_now_button_color}
            onChange={handleChange}
          />
        </div>

        <div className="pkdc-input-field">
          <label className="pkdc-label" htmlFor="buy_now_font_color">
            Font Color
          </label>
          <input
            type="color"
            className="input-box-style"
            name="buy_now_font_color"
            id="buy_now_font_color"
            value={formValues.buy_now_font_color}
            onChange={handleChange}
          />
        </div>

        <div className="pkdc-input-field">
          <label className="pkdc-label" htmlFor="buy_now_font_size">
            Font Size
          </label>
          <input
            type="number"
            className="input-box-style"
            name="buy_now_font_size"
            id="buy_now_font_size"
            value={formValues.buy_now_font_size}
            onChange={handleChange}
          />
        </div>

        <div>
          <input
            type="submit"
            id="save-btn"
            className="button button-primary"
            name="submit_pk_direct_checkout_settings"
            value="Save Changes"
          />
        </div>
      </form>
      {showSuccessMessage && (
        <div
          className="success-message"
          style={{ color: "green", fontWeight: "bold", fontSize: "18px" }}
        >
          Data submitted successfully!
        </div>
      )}
    </div>
  );
};

export default FormLayout;
